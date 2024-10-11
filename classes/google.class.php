<?php
require_once 'vendor/autoload.php';

class GoogleLogin {
    private $clientID;
    private $clientSecret;
    private $redirectUri;
    private $connect;
    private $client;

    public function __construct($dbConnection) {
        // Initialize database connection
        $this->connect = $dbConnection;

        // Set Google Client configuration
        $this->clientID = 'YOUR_CLIENT_ID';  // Replace with your actual client ID
        $this->clientSecret = 'YOUR_CLIENT_SECRET'; // Replace with your actual client secret
        $this->redirectUri = 'http://localhost/phptraining/Projects/foxclore/login.php'; // Replace with your redirect URI

        // Initialize Google Client
        $this->client = new Google_Client();
        $this->client->setClientId($this->clientID);
        $this->client->setClientSecret($this->clientSecret);
        $this->client->setRedirectUri($this->redirectUri);
        $this->client->addScope("email");
        $this->client->addScope("profile");
    }

    // Method to get the Google Login URL
    public function getAuthUrl() {
        return $this->client->createAuthUrl();
    }

    // Method to handle Google Login callback
    public function handleCallback() {
        if (isset($_GET['code'])) {
            // Authenticate the code from Google OAuth Flow
            $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
            $this->client->setAccessToken($token['access_token']);

            // Get profile information
            $google_oauth = new Google_Service_Oauth2($this->client);
            $google_account_info = $google_oauth->userinfo->get();
            $email = $google_account_info->email;
            $fullname = $google_account_info->name;

            // Check if the user already exists in the database
            $query = "SELECT * FROM login WHERE email = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // User exists, log them in
                $user = $result->fetch_assoc();
                $_SESSION['user'] = $user['fullname'];
                $_SESSION['userid'] = $user['id'];
            } else {
                // New user, insert into the database
                $query = "INSERT INTO login (fullname, email) VALUES (?, ?)";
                $stmt = $this->connect->prepare($query);
                $stmt->bind_param('ss', $fullname, $email);
                $stmt->execute();

                $_SESSION['user'] = $fullname; // Set session variable
            }

            // Redirect to homepage after login
            header("Location: index.php");
            exit();
        }
    }
}
?>
