<?php
    include('common/connection.php');
    include('classes/login.class.php');
    if (session_status() === PHP_SESSION_ACTIVE) 
    {
        session_unset(); // Clear all session variables
        session_destroy(); // Destroy the session
    }
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
    include("google.php");
    include("face.php");
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
