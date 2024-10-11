<?php
  include("common/connection.php");
  include("classes/login.class.php"); 
  $user = new login($connect);
  if (isset($_POST['contact'])) 
  {
    $user->contactus(); 
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="css/style2.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="container">
      <span class="big-circle"></span>
      <img src="images/shape.png" class="square" alt="" />
      <div class="form">
        <div class="contact-info">
          <h3 class="title">Let's get in touch</h3>
          <p>
            We are here to assist you with any inquiries or support you need. Reach out to us and we'll get back to you as soon as possible!
          </p>
          <div class="information">
            <img src="images/location.png" class="icon" alt="" />
            <p>123 Business Street, Techville, CA 94016</p>
          </div>
          <div class="information">
            <img src="images/email.png" class="icon" alt="" />
            <p>MyBlog@gmail.com</p>
          </div>
          <div class="information">
            <img src="images/phone.png" class="icon" alt="" />
            <p>+91 9876543210</p>
          </div>
          <div class="social-media">
            <p>Connect with us :</p>
            <div class="social-icons">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="contact-form">
          <span class="circle one"></span>
          <span class="circle two"></span>

          <form action="" method="POST" autocomplete="off">
          <h3 class="title">Contact us</h3>
          <div class="input-container">
            <input type="text" name="fullname" class="input" required />
            <label for="name">Name</label>
            <span>Name</span>
          </div>
          <div class="input-container">
            <input type="email" name="email" class="input" required />
            <label for="email">Email</label>
            <span>Email</span>
          </div>
          <div class="input-container textarea">
            <textarea name="message" class="input" required></textarea>
            <label for="message">Message</label>
            <span>Message</span>
          </div>
          <input type="submit" value="Send" class="btn" name="contact" />
        </form>

        </div>
      </div>
    </div>

    <script src="js/app.js"></script>
  </body>
</html>
