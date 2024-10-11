<?php
// Check if session is already started
if (session_status() === PHP_SESSION_NONE) 
{
    session_start(); 
} 

// Initialize Facebook SDK
require 'vendor/autoload.php';

// Database connection
$connect = mysqli_connect("localhost", "root", "", "myproject1") or die("Connection Failed");

// Facebook SDK initialization
$fb = new Facebook\Facebook([
    'app_id' => '1490204078350931', // your app id
    'app_secret' => '49264289b24ed03dfc1bcd891673231a', // your app secret
    'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional

// Define the redirect URI
$redirectUri = 'http://localhost/phptraining/Projects/foxclore/index.php';

try {
    // Ensure session is started and access token is fetched
    if (isset($_SESSION['facebook_access_token'])) {
        $accessToken = $_SESSION['facebook_access_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

// Check if we have an access token
if (isset($accessToken)) {
    $_SESSION['facebook_access_token'] = (string) $accessToken; // Save the access token
    $fb->setDefaultAccessToken($accessToken);

    // Getting basic info about user
    try {
        $profile_request = $fb->get('/me?fields=name,first_name,last_name,email,picture.width(200).height(200)');
        $profile = $profile_request->getGraphUser();
        $fbid = $profile->getProperty('id');
        $fbfullname = $profile->getProperty('name');
        $fbemail = $profile->getProperty('email');
        $fbpic = $profile->getPicture()->getUrl(); 

        // Save user information in session variable
        $_SESSION['fb_id'] = $fbid;
        $_SESSION['fb_name'] = $fbfullname;
        $_SESSION['fb_email'] = $fbemail;
        $_SESSION['fb_pic'] = $fbpic;

        // Check if the user already exists in the database
        $query = "SELECT * FROM login WHERE email = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $fbemail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Insert user data into the database
            $stmt = $connect->prepare("INSERT INTO login (fullname, email, is_verified) VALUES (?, ?, 1)");
            $stmt->bind_param("ss", $fbfullname, $fbemail);
            if ($stmt->execute()) {
                echo "User data inserted successfully!";
            } else {
                echo "Error inserting data: " . $stmt->error;
            }
        }

        $_SESSION['user'] = $fbfullname;
        header('Location: index.php');
        exit();
        $stmt->close();
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        if ($e->getCode() == 102) { // Token is invalid
            session_destroy();
            header("Location: ./"); // Redirect to your login page
            exit;
        }
        exit;
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
} else {
    // Generate login URL with the correct redirect URI
    $loginUrl = $helper->getLoginUrl($redirectUri, $permissions);
    
    // Check if state is not already set in the session
    if (!isset($_SESSION['FBRLH_state'])) {
        $_SESSION['FBRLH_state'] = bin2hex(random_bytes(16)); // Generate a new state
    }

    // Append state to the login URL
    $loginUrl .= '&state=' . $_SESSION['FBRLH_state'];
}
?>
