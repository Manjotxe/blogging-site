<?php
    include("common/connection2.php");
    include("classes/addpost.class.php");

    // Initialize variables for the post details
    $title = "";
    $category = "";
    $content = "";
    $image = "";

    // Check if an 'eid' is passed in the URL
    if (isset($_GET['eid'])) 
    {
        $postId = $_GET['eid'];

        // Create an instance of AddPost
        $addPost = new AddPost($pdo);

        // Fetch the post details
        $post = $addPost->getPostById($postId);

        // Check if the post was found
        if ($post) 
        {
            $title = $post['title'];
            $category = $post['category'];
            $content = $post['content'];
            $image = $post['images']; // Assuming the image URL is stored in the database
        } 
        else 
        {
            // Handle the case where the post does not exist
            echo "Post not found!";
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <script src="https://cdn.tiny.cloud/1/cryl9extu64qm6m5abvkf98a4e2ut37sqxw7koum5kw2d9do/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="css/post.css?v=1.1"> <!-- Optional: Your own styles -->
    <style>
        .login-redirect
        {
            background-color: #4CAF50; 
            border: none; 
            color: white; 
            padding: 15px 30px; 
            text-align: center;
            text-decoration: none; 
            display: inline-block; 
            font-size: 16px; 
            font-weight: bold; 
            margin: 10px 5px; 
            cursor: pointer; 
            border-radius: 50px; 
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="form-container" >
        <h1><?php echo isset($postId) ? "Edit Post" : "Add New Post"; ?></h1>
        <form id="addPostForm" action="process_post.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
            </div>
            <div>
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value=""> &lt; Select Option &gt; </option>
                    <option value="clothes" <?php if ($category === "clothes") echo "selected"; ?>>Clothes</option>
                    <option value="electronics" <?php if ($category === "electronics") echo "selected"; ?>>Electronics</option>
                    <option value="books" <?php if ($category === "books") echo "selected"; ?>>Books</option>
                    <option value="furniture" <?php if ($category === "furniture") echo "selected"; ?>>Furniture</option>
                    <option value="sports" <?php if ($category === "sports") echo "selected"; ?>>Sports</option>
                    <option value="accessories" <?php if ($category === "accessories") echo "selected"; ?>>Accessories</option>
                </select>
            </div>
            <div>
                <label for="content">Content:</label>
                <textarea id="content" name="content"><?php echo htmlspecialchars($content); ?></textarea>
            </div>
            <div>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" <?php echo isset($image) ? '' : 'required'; ?>>
                <?php if ($image): ?>
                    <p>Current Image: <img src="<?php echo htmlspecialchars($image); ?>" alt="Current Post Image" style="max-width: 100px;"></p>
                <?php endif; ?>
            </div>
            <div>
                <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($postId); ?>"> <!-- Send the post ID for processing -->
                <?php if(!empty($_SESSION['user'])): ?>
                    <button type="submit" name="add"><?php echo isset($postId) ? "Update Post" : "Add Post"; ?></button>
                <?php else: ?>
                    <a href="login.php"><input type="button" class="login-redirect" value="First Login, To create a Post"></a>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <script>
        // Initialize TinyMCE on the content textarea
        tinymce.init({
            selector: 'textarea#content',
            plugins: 'advlist autolink lists link image charmap print preview hr code table',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | table',
            menubar: false,
            height: 300,
            content_style: "body { font-family: Arial, sans-serif; font-size: 14px; }", // Customize font inside the editor
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: function (callback, value, meta) {
                if (meta.filetype === 'image') {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function () {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function () {
                            callback(reader.result, { alt: file.name });
                        };
                        reader.readAsDataURL(file);
                    };
                    input.click();
                }
            }
        });
    </script>
</body>
</html>
