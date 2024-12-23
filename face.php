<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("common/connection.php");
require_once 'vendor/autoload.php';
// Facebook login
$fb = new Facebook\Facebook([
    'app_id' => '566760639149464', //  app id
    'app_secret' => 'a5d8192b659205735c7c4afe254aa30b', //  app secret
    'default_graph_version' => 'v2.4',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email'];

try {
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

if (isset($accessToken)) {
    // Set default access token
    $fb->setDefaultAccessToken((string) $accessToken);

    // Getting basic info about user
    try {
        $profile_request = $fb->get('/me?fields=name,email');
        $profile = $profile_request->getGraphUser();

        $fbid = $profile->getField('id');
        $fbfullname = $profile->getField('name');
        $fbemail = $profile->getField('email');

        $_SESSION['fbid'] = $fbid . '</br>';
        $_SESSION['fbname'] = $fbfullname . '</br>';
        $_SESSION['fbemail'] = $fbemail . '</br>';
        // If you have a profile picture URL:
        // Check if the user already exists
        $stmt = $connect->prepare("SELECT * FROM `login` WHERE email=?");
        $stmt->bind_param("s", $fbemail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // User does not exist, insert new user
            $insert_stmt = $connect->prepare("INSERT INTO `login` (fullname, email, is_verified) VALUES (?, ?, 1)");
            $insert_stmt->bind_param("ss", $fbfullname, $fbemail);
            $insert_stmt->execute();
            $insert_stmt->close();
        }

        // Log the user in
        $_SESSION['user'] = $fbfullname;
        header('Location: index.php');
        exit();
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
} else {
    // Generate login URL
    $loginUrl = $helper->getLoginUrl('http://localhost/phptraining/Projects/foxclore/face.php', $permissions);
}
