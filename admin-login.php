<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin-login.css">
    <title>Login</title>
</head>
<body>
    <div class="main-login">
        <div class="left-login">
            <h1>Admin Login<br>Login For Admin for Full Control</h1>
            <img src="animation/witch-animate.svg" class="left-login-image" alt="Animated image">
        </div>

        <div class="right-login">
            <div class="card-login">
                <h1>LOGIN</h1>
                <form action="process_login.php" method="POST"> <!-- Added form -->
                    <div class="textfield">
                        <label for="usuario">Username</label>
                        <input type="text" name="username" placeholder="Username" required> <!-- Changed name -->
                    </div>
                    <div class="textfield">
                        <label for="senha">Password</label>
                        <input type="password" name="password" placeholder="Password" required> <!-- Changed name -->
                    </div>
                    <button type="submit" class="btn-login">Login</button>
                </form> <!-- End of form -->
                <div class="btn-plus">
                    <a class="btn-cadastre-se">Not an Admin? <span class="span-cadastre-se">Login as user</span></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
