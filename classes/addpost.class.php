<?php
class AddPost 
{
    private $title;
    private $category;
    private $content;
    private $image;
    private $connect;

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
                $this->insertPost($this->title, $this->category, $this->content, $targetFilePath);
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
    private function insertPost($title, $category, $content, $imagePath) 
    {
        $stmt = $this->connect->prepare("INSERT INTO blogs (title, category, content, images) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $category, $content, $imagePath]);

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
}
?>
