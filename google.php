<?php    
    require_once 'vendor/autoload.php';
    // init configuration
    $clientID = '129422395676-rvo4bj4mj894llhgv44arcsqhs8ulhov.apps.googleusercontent.com'; // your client id
    $clientSecret = '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'; // your client secret
    $redirectUri = 'http://localhost/phptraining/Projects/foxclore/login.php';

    // create Client Request to access Google API
    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope("email");
    $client->addScope("profile");

    // authenticate code from Google OAuth Flow
    if (isset($_GET['code'])) 
    {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        // get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email =  $google_account_info->email;
        $fname =  $google_account_info->name;
    }
    if (isset($email)) 
    {
        $query = "SELECT * FROM login WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        
        if (mysqli_num_rows($result) > 0) 
        {
            // User already exists
            $r = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $r['fullname'];
            $_SESSION['userid'] = $r['id'];
        } 
        else 
        {
            // New user, insert into database
            $query = "INSERT INTO login (fullname, email) VALUES ('$fname', '$email')";
            mysqli_query($connect, $query);
            $_SESSION['user'] = $fname; // Set the session variable
        }
        header("Location: index.php"); 
        exit();
    } 
?>