<?php
class CategoryManager
{
    private $pdo;  // Database connection

    // Constructor to accept and store the database connection
    public function __construct($dbConnection)
    {
        $this->pdo = $dbConnection;
    }

    // Method to fetch categories from the database
    public function getCategories()
    {
        $stmt = $this->pdo->query("SELECT category_name FROM categories ORDER BY category_name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to display categories as HTML list
    public function displayCategories()
    {
        $categories = $this->getCategories(); // Fetch categories
        if ($categories) {
            foreach ($categories as $category) {
                $categoryName = htmlspecialchars($category['category_name']);
                echo "<li><a href='index.php?category={$categoryName}'>{$categoryName}</a></li>";
            }
        } else {
            echo "<li>No categories available</li>";
        }
    }
}
?>
