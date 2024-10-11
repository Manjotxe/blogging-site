<?php
include("common/connection2.php");
$category = isset($_GET['category']) ? $_GET['category'] : '';
if(!empty($category))
{
    echo "Filtering by category: " . htmlspecialchars($category); // Debugging output

    // Prepare the SQL statement to fetch posts by the specified category
    $stmt = $pdo->prepare("SELECT id, title, category, images, content FROM blogs WHERE category = ? ORDER BY id DESC");
    $stmt->execute([$category]); // Bind the category value to the query
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all posts that match the category
}
else
{
    $stmt = $pdo->query("SELECT id, title, category, images, content FROM blogs ORDER BY id DESC");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all posts
}
?>

<?php if ($posts): ?>
    <section id="introblocks">
        <ul class="nospace group">
            <?php foreach ($posts as $post): ?>
                <li class="one_third">
                    <figure>
                        <a class="imgover" href="#">
                            <img src="<?php echo htmlspecialchars($post['images']); ?>" alt="">
                        </a>
                        <figcaption>
                            <h6 class="heading"><?php echo htmlspecialchars($post['title']); ?></h6>
                            <div><?php echo strip_tags($post['content']); ?></div>
                        </figcaption>
                    </figure>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php else: ?>
    <p>No posts available in this category.</p>
<?php endif; ?>
