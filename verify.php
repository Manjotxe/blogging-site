<?php
    include('common/connection.php');

    if (isset($_GET['email']) && isset($_GET['token']))
    {
        $email = $_GET['email'];
        $token = $_GET['token'];

        $query = "SELECT * FROM login WHERE email='$email' AND token='$token' AND status=0";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);

        if ($count > 0)
        {
            
            $query = "UPDATE login SET status=1 WHERE email='$email' AND token='$token'";
            if (mysqli_query($connect, $query)) 
            {
                echo "Your account has been successfully verified! Head back and login to MyBlog";
                echo "<br/>";
                echo "<a href='http://localhost/phptraining/Projects/foxclore/login.php'>Click Me!!!</a>";
            } 
            else 
            {
                echo "Error updating status.";
            }
        } 
        else
        {
            echo "Invalid or expired token!";
        }
    } 
    else 
    {
        echo "No token or email provided!";
    }
?>
