<?php
  include("common/connection2.php");
  include("classes/addpost.class.php");
  $addPost = new AddPost($pdo);
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
    $addPost->add();
  }
  header('Location: index.php');
?>
