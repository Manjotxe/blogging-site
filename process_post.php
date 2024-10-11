<?php
include("common/connection2.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];
    $content = strip_tags($content, '<p><br>');

    // Image upload logic
    $targetDir = "uploads/"; // Create this directory if it doesn't exist
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION)); // Get image file extension
    $newFileName = time() . '.' . $imageFileType; // Generate a new file name based on the current time
    $targetFilePath = $targetDir . $newFileName; // Full path to the new file

    // Check if image file is a valid image format
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) 
    {
        die("File is not an image.");
    }

    // Move the uploaded image to the uploads directory with the new file name
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) 
    {
        // Image successfully uploaded, now insert the post data including image path to the database
        $stmt = $pdo->prepare("INSERT INTO blogs (title, category, content ,images) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $category, $content, $targetFilePath]);

        ?>
		    <script>
				alert("Post added successfully with image!")
			</script>
	    <?php
    } 
    else 
    {
        ?>
		    <script>
				alert("Error uploading image.")
			</script>
	    <?php
    }
}
header('Location: index.php');
?>
