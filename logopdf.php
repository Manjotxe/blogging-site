<?php
include('common/connection2.php');
include('classes/display.class.php');

// Check if post ID is passed in the URL
if (isset($_GET['id'])) 
{
    $postId = $_GET['id'];

    // Create an instance of DisplayPosts
    $display = new DisplayPosts($pdo);

    // Fetch the specific post
    $stmt = $pdo->prepare("SELECT id, title, category, images, content FROM blogs WHERE id = ?");
    $stmt->execute([$postId]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch the data and decode HTML entities
    $postTitle = html_entity_decode($post['title']);   // Title
    $postContent = html_entity_decode(strip_tags($post['content'], '<br>'));  // Content
    $postImage = $post['images'];   // Image (already stored as path)
} 
else 
{
    // Redirect to index if no post ID is provided
    header('Location: index.php');
    exit();
}

require('fpdf/fpdf.php');

class PDF extends FPDF
{
    private $postTitle;
    private $postContent;
    private $postImage;

    // Constructor to accept title, content, and image
    public function __construct($title, $content, $image)
    {
        parent::__construct();
        $this->postTitle = $title;
        $this->postContent = $content;
        $this->postImage = $image;
    }

    // Page header
    function Header()
    {
        // Display the post image instead of the logo
        if (file_exists($this->postImage)) {
            $this->Image($this->postImage, 60, 10, 90); // Adjust the image size and position
        }

        // Arial bold 15 for the title
        $this->SetFont('Arial','B',15);
        $this->Ln(60); // Line break to adjust space below the image

        // Title
        $this->Cell(0,10,$this->postTitle,0,1,'C'); // Title centered

        // Line break
        $this->Ln(10);
    }

    // Page body content
    function Content()
    {
        // Set font for content
        $this->SetFont('Arial','',12);
        // Output the content of the post, centered
        $this->MultiCell(0,10,$this->postContent,0,'C');
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Instantiation of inherited class
$pdf = new PDF($postTitle, $postContent, $postImage); // Pass title, content, and image
$pdf->AliasNbPages();
$pdf->AddPage();

// Display the content
$pdf->Content();

$pdf->Output();
?>
