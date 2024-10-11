<?php
    include("common/connection2.php");
    include("classes/display.class.php");

    $display = new DisplayPosts($pdo);
    $category = isset($_GET['category']) ? $_GET['category'] : '';
    $searchbutton = isset($_GET['search']) ? $_GET['search'] : '';

    if (!empty($category)) 
    {
        echo "Filtering by category: " . htmlspecialchars($category); 
        $posts = $display->getPostsByCategory($category);
    } 
    elseif (!empty($searchbutton)) 
    {
        echo "Searching for: " . htmlspecialchars($searchbutton);
        $posts = $display->searchPosts($searchbutton);
    } 
    else 
    {
        $posts = $display->getAllPosts();
    }

    // Display the posts
    $display->displayPosts($posts);
?>
