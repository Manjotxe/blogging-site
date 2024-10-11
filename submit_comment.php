<?php
    session_start();
    include('common/connection2.php');

    // Handle form submission
    if (isset($_POST['submit_comment']) && !empty($_SESSION['user'])) 
    {
        $comment = trim($_POST['comment']);
        $postId = $_POST['id']; // Make sure to send the post ID via GET or hidden input

        if (!empty($comment)) 
        {
            // Insert the comment into the database
            $stmt = $pdo->prepare("INSERT INTO comments (post_id, username, comment) VALUES (?, ?, ?)");
            $stmt->execute([$postId, $_SESSION['user'], $comment]);

            // Redirect back to the post page after submission
            header('Location: post.php?id=' . $postId);
            exit();
        } 
        else 
        {
            echo "Please enter a comment.";
        }
    } 
?>
