<?php
class Verify 
{
    private $email;
    private $token;
    private $connect;

    public function __construct($dbConnection) 
    {
        $this->connect = $dbConnection;
    }

    public function verifyAccount() 
    {
        // Check if both email and token are set in the URL
        if (isset($_GET['email']) && isset($_GET['token'])) 
        {
            $this->email = $_GET['email'];
            $this->token = $_GET['token'];

            // Prepare and execute the query to find the user with the matching email and token
            $stmt = $this->connect->prepare("SELECT * FROM login WHERE email = ? AND token = ? AND status = 0");
            $stmt->bind_param("ss", $this->email, $this->token);
            $stmt->execute();
            $result = $stmt->get_result();
            $count = $result->num_rows;

            if ($count > 0) 
            {
                // If a match is found, update the account status to verified
                $updateStmt = $this->connect->prepare("UPDATE login SET status = 1 WHERE email = ? AND token = ?");
                $updateStmt->bind_param("ss", $this->email, $this->token);

                if ($updateStmt->execute()) 
                {
                    // Success message after successful update
                    echo "Your account has been successfully verified! Head back and login to MyBlog";
                    echo "<br/>";
                    echo "<a href='http://localhost/phptraining/Projects/foxclore/login.php'>Click Me!!!</a>";
                } 
                else 
                {
                    echo "Error updating status.";
                }
                $updateStmt->close();
            } 
            else 
            {
                // If no match or already verified
                echo "Invalid or expired token!";
            }

            $stmt->close();
        } 
        else 
        {
            echo "No token or email provided!";
        }
    }
}
?>
