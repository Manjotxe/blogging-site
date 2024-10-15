<?php
    session_start();
    include('common/connection2.php'); // Include your database connection

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare and execute SQL statement
        $stmt = $pdo->prepare("SELECT * FROM `admin-login` WHERE username = ? AND password = ? LIMIT 1");
        $stmt->execute([$username, $password]);

        // Check if the user exists
        if ($stmt->rowCount() > 0) 
        {
            // User exists, start session and redirect
            $_SESSION['user'] = $username; // Save the username in session
            header("Location: blog-adminpanel.php"); // Redirect to the desired page
            exit();
        } 
        else 
        {
            // No such admin exists
            echo "<script>alert('No such admins exist.'); window.history.back();</script>";
        }
    }
?>
