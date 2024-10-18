<?php
include('common/connection2.php');
include('classes/display.class.php');

// Check if the category is passed in the URL
if (isset($_GET['category'])) 
{
    $category = $_GET['category'];

    // Create an instance of DisplayPosts
    $display = new DisplayPosts($pdo);

    // Fetch all posts for the specified category
    $posts = $display->getPostsByCategory($category);

    // Check if any posts were found
    if (!$posts) {
        // Redirect to index or display a message if no posts are found
        header('Location: index.php');
        exit();
    }
} 
else 
{
    // Redirect to index if no category is provided
    header('Location: index.php');
    exit();
}

require('fpdf/fpdf.php');

class PDF extends FPDF
{
    private $postTitle;
    private $postContent;
    private $postImage;

    // Page header
    function Header()
    {
        // Title
        $this->SetFont('Arial','B',15);
        $this->Cell(0,10,'Posts in Category: ' . htmlspecialchars($_GET['category']), 0, 1, 'C');
        $this->Ln(10); // Line break
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

    // Function to add post
    public function addPost($title, $content, $image)
    {
        // Display the post image
        if (file_exists($image)) {
            $this->Image($image, 60, $this->GetY(), 90); // Adjust the image size and position
            $this->Ln(60); // Line break to adjust space below the image
        }

        // Title
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,html_entity_decode(strip_tags($title)),0,1,'C'); // Title centered
        $this->Ln(10); // Line break

        // Content
        $this->SetFont('Arial','',12);
        $this->MultiCell(0,10,html_entity_decode(strip_tags($content))); // Output content
        $this->Ln(10); // Additional line break after content
    }
}

// Instantiation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();

// Loop through each post and add it to the PDF
foreach ($posts as $post) {
    $pdf->AddPage(); // Start a new page for each post
    $pdf->addPost($post['title'], $post['content'], $post['images']); // Call to add each post
}

// Output the PDF
$pdf->Output();
?>
