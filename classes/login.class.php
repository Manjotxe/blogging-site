<?php
class login {
    private $username;
    private $password;
    private $connect;
    private $fname;
    private $email;
    private $pass;
    private $token;
    private $subject;
    private $message;
    private $headers;

    public function __construct($dbConnection)
    {
        $this->connect = $dbConnection;
    } 
    function login()
    {
        $this->username = $_POST['email'];
        $this->password = $_POST['password'];
        

        $stmt = $this->connect->prepare("SELECT * FROM login WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $this->username, $this->password);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->num_rows;

        if ($count > 0) 
        {
            $row = $result->fetch_assoc();
            $fullname = $row['fullname']; 
            // Start a session and redirect on successful login
            session_start();
            $_SESSION['user'] = $fullname; // Store username in session
            header('location:index.php'); 
        } else 
        {
            ?>
				<script>
					alert("Login Not Successful")
				</script>
			<?php
        }

        $stmt->close();
    }
    function signup()
    {
        $this->fname=$_POST['fullname'];
		$this->email=$_POST['email'];
		$this->pass = $_POST['pass']; 
        $this->token = bin2hex(random_bytes(50));
		$this->subject = "Sign-up Verification for MyBlog";
		$this->message ="Kindly click the following link to verify your account and complete the registration: <br/>
        <a href='http://localhost/phptraining/Projects/foxclore/verify.php?email=$this->email&token=$this->token'>Verify your email</a>";  
		$this->headers = "From: mtmanjot@gmail.com\r\n".
		 "Reply-To: mtmanjot@gmail.com\r\n".
		 "Content-Type: text/html; charset=UTF-8\r\n";
		
		$query = "INSERT INTO login (fullname, email, password, token, status) VALUES ('$this->fname', '$this->email', '$this->pass', '$this->token', 0)";
        mysqli_query($this->connect, $query);
		
		if(mail($this->email, $this->subject, $this->message, $this->headers))
		{
			?>
				<script>
					alert("We've sent you an email.Please verify yourself by clicking the link")
				</script>
			<?php
		} 		
		else
		{
			?>
				<script>
					alert("Signup Not Completed, Try again")
				</script>
			<?php
		}
    }
    function contactus()
    {
        $this->fname=$_POST['fullname'];
		$this->email=$_POST['email'];
        $this->token = bin2hex(random_bytes(50));
		$this->subject = "FeedBack from consumer of my bloggin site";
		$this->message =$_POST['message'];  
		$this->headers = "From: mtmanjot@gmail.com\r\n".
		 "Reply-To: mtmanjot@gmail.com\r\n".
		 "Content-Type: text/html; charset=UTF-8\r\n";
		
		
		if(mail($this->email, $this->subject, $this->message, $this->headers))
		{
			?>
				<script>
					alert("Thanks for your feedback!!")
				</script>
			<?php
		} 		
		else
		{
			?>
				<script>
					alert("error")
				</script>
			<?php
		}
    }
}
?>
