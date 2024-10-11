<?php
    include('common/connection.php');
    include('classes/login.class.php');
    if (session_status() === PHP_SESSION_ACTIVE) 
    {
        session_unset(); // Clear all session variables
        session_destroy(); // Destroy the session
    }
    include('face.php');
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start(); 
    }
    $user = new login($connect);
    if (isset($_POST['loginform'])) 
    {
        $user->login(); // Create a new login instance
    }
    if (isset($_POST['signupform'])) 
    {
        $user->signup();
    }
?>	
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Signup Form</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .container {
            background-color: grey;
        }

        .field button {
            background-color: #41C379;
        }

        .field button:hover {
            background-color: green;
        }
    </style>
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
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
    <section class="container forms">
        <!-- Login Form -->
        <div class="form login">
            <div class="form-content">
                <header>Login</header>
                <form method="post" action="">
                    <div class="field input-field">
                        <input type="email" placeholder="Email" class="input" name="email" required>
                    </div>

                    <div class="field input-field">
                        <input type="password" placeholder="Password" class="password" name="password" required>
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <div class="form-link">
                        <a href="#" class="forgot-pass">Forgot password?</a>
                    </div>

                    <div class="field button-field">
                        <button type="submit" name="loginform">Login</button>
                    </div>
                </form>

                <div class="form-link">
                    <span>Don't have an account? <a href="#" class="link signup-link">Signup</a></span>
                </div>
            </div>

            <div class="line"></div>

            <div class="media-options">
                <a href="<?php echo $loginUrl ?>" class="field facebook">
                    <i class='bx bxl-facebook facebook-icon'></i>
                    <span>Login with Facebook</span>
                </a>
            </div>

            <div class="media-options">
                <a href="<?php echo $client->createAuthUrl(); ?>" class="field google"> <!-- Corrected link -->
                    <img src="images/google.png" alt="" class="google-img">
                    <span>Login with Google</span>
                </a>
            </div>
        </div>

       
        <div class="form signup">
            <div class="form-content">
                <header>Signup</header>
                <form method="post" action="#">
                    <div class="field input-field">
                        <input type="text" placeholder="Fullname" class="input" name="fullname">
                    </div>

                    <div class="field input-field">
                        <input type="email" placeholder="Email" class="password" name="email">
                    </div>

                    <div class="field input-field">
                        <input type="password" placeholder="Create password" class="password" name="pass">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <div class="field button-field">
                        <button type="submit" name="signupform">Signup</button>
                    </div>
                </form>

                <div class="form-link">
                    <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
                </div>
            </div>

            <div class="line"></div>

            <div class="media-options">
               <a href="<?php echo $loginUrl ?>" class="field facebook">
                    <i class='bx bxl-facebook facebook-icon'></i>
                    <span>Login with Facebook</span>
                </a>
            </div>

            <div class="media-options">
                <a href="<?php echo $client->createAuthUrl(); ?>" class="field google">
                    <img src="images/google.png" alt="" class="google-img">
                    <span>Login with Google</span>
                </a>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script src="js/script.js"></script>
</body>
</html> 
