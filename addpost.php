<?php
    include("common/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <script src="https://cdn.tiny.cloud/1/cryl9extu64qm6m5abvkf98a4e2ut37sqxw7koum5kw2d9do/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="css/post.css?v=1.1"> <!-- Optional: Your own styles -->
</head>
<body>
    <div class="form-container" >
        <h1>Add New Post</h1>
        <form id="addPostForm" action="process_post.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option>&lt; Select Option &gt;</option>
                    <option value="clothes">Clothes</option>
                    <option value="electronics">Electronics</option>
                    <option value="books">Books</option>
                    <option value="furniture">Furniture</option>
                    <option value="sports">Sports</option>
                    <option value="accessories">Accessories</option>
                </select>
            </div>
            <div>
                <label for="content">Content:</label>
                <textarea id="content" name="content"></textarea>
            </div>
            <div>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <div>
                <button type="submit" name="add">Add Post</button>
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
            images_upload_url: '/upload', // URL to upload images (change as needed)
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
