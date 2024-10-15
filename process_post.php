<?php
  include("common/connection2.php");
  include("classes/addpost.class.php");
  $addPost = new AddPost($pdo);

  // Check if it's an update request
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
      if (isset($_POST['post_id'])) 
      {
          $addPost->update($_POST['post_id']);
      } 
      else 
      {
          $addPost->add();
      }
  }
  header('Location: index.php');
?>
