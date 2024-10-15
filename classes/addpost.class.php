<?php
session_start();
class AddPost 
{
    private $title;
    private $category;
    private $content;
    private $image;
    private $connect;
    private $username;

    public function __construct($dbConnection) 
    {
        $this->connect = $dbConnection;
    }

    // Function to add a blog post
    public function add() 
    {
        $this->title = $_POST['title'];
        $this->category = $_POST['category'];
        $this->content = strip_tags($_POST['content'], '<p><br>');
        $this->username = $_SESSION['user'];

        // Image upload logic
        $targetDir = "uploads/";
        $this->image = $_FILES["image"];
        $imageFileType = strtolower(pathinfo($this->image["name"], PATHINFO_EXTENSION));
        $newFileName = time() . '.' . $imageFileType;
        $targetFilePath = $targetDir . $newFileName;

        // Validate that the file is an image
        if ($this->isValidImage($this->image["tmp_name"])) 
        {
            if ($this->uploadImage($targetFilePath)) 
            {
                // Insert post data into database
                $this->insertPost($this->title, $this->category, $this->content,$this->username, $targetFilePath);
            } 
            else 
            {
                $this->displayAlert("Error uploading image.");
            }
        }
        else 
        {
            $this->displayAlert("File is not a valid image.");
        }
    }

    // Function to check if the file is a valid image
    private function isValidImage($filePath) 
    {
        $check = getimagesize($filePath);
        return $check !== false;
    }

    // Function to upload the image
    private function uploadImage($targetFilePath) 
    {
        return move_uploaded_file($this->image["tmp_name"], $targetFilePath);
    }

    // Function to insert post into the database
    private function insertPost($title, $category, $content,$username, $imagePath) 
    {
        $stmt = $this->connect->prepare("INSERT INTO blogs (username,title, category, content, images) VALUES (?, ?, ?, ?,?)");
        $stmt->execute([$username,$title, $category, $content, $imagePath]);

        if ($stmt) 
        {
            $this->displayAlert("Post added successfully with image!");
        } else 
        {
            $this->displayAlert("Error adding post to database.");
        }
    }

    // Function to display JavaScript alerts
    private function displayAlert($message) 
    {
        echo "<script>alert('{$message}');</script>";
    }
    public function getPostById($postId)
    {
        $stmt = $this->connect->prepare("SELECT title, category, content, images FROM blogs WHERE id = ?");
        $stmt->execute([$postId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function update($postId) 
    {
        // Get the post details from the form
        $this->title = $_POST['title'];
        $this->category = $_POST['category'];
        $this->content = strip_tags($_POST['content'], '<p><br>');
        $this->username = $_SESSION['user'];

        // Check if an image was uploaded
        if (!empty($_FILES["image"]["name"])) 
        {
            // Image upload logic
            $targetDir = "uploads/";
            $this->image = $_FILES["image"];
            $imageFileType = strtolower(pathinfo($this->image["name"], PATHINFO_EXTENSION));
            $newFileName = time() . '.' . $imageFileType;
            $targetFilePath = $targetDir . $newFileName;

            // Validate that the file is an image
            if ($this->isValidImage($this->image["tmp_name"])) 
            {
                if ($this->uploadImage($targetFilePath)) 
                {
                    // Update post data in database with new image
                    $this->updatePost($postId, $this->title, $this->category, $this->content, $targetFilePath);
                } 
                else 
                {
                    $this->displayAlert("Error uploading image.");
                }
            } 
            else 
            {
                $this->displayAlert("File is not a valid image.");
            }
        } 
        else 
        {
            // Update post data in database without changing the image
            $this->updatePost($postId, $this->title, $this->category, $this->content);
        }
    }

    // Function to update post in the database
    private function updatePost($postId, $title, $category, $content, $imagePath = null) 
    {
        if ($imagePath) 
        {
            // Update with new image path
            $stmt = $this->connect->prepare("UPDATE blogs SET title = ?, category = ?, content = ?, images = ? WHERE id = ?");
            $stmt->execute([$title, $category, $content, $imagePath, $postId]);
        } 
        else 
        {
            // Update without changing the image
            $stmt = $this->connect->prepare("UPDATE blogs SET title = ?, category = ?, content = ? WHERE id = ?");
            $stmt->execute([$title, $category, $content, $postId]);
        }

        if ($stmt) 
        {
            $this->displayAlert("Post updated successfully!");
        } 
        else 
        {
            $this->displayAlert("Error updating post in database.");
        }
    }
}
?>
