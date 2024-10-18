<?php
class DisplayPosts 
{
    private $pdo;

    public function __construct($dbConnection)
    {
        $this->pdo = $dbConnection;
    }

    // Helper function to limit content to a specified number of words
    private function limitContent($content, $wordLimit = 30) 
    {
        $content = strip_tags($content); // Remove HTML tags
        $words = explode(' ', $content); // Split content into words
        if (count($words) > $wordLimit) {
            $limitedContent = implode(' ', array_slice($words, 0, $wordLimit)) . '...'; // Limit to word count and add ellipsis
        } else {
            $limitedContent = $content; // If content is already within the limit
        }
        return $limitedContent;
    }

    // Fetch posts by category and status
    public function getPostsByCategory($category)
    {
        $stmt = $this->pdo->prepare("SELECT id, title, category, images, content FROM blogs WHERE category = ? AND status = ? ORDER BY id DESC");
        $stmt->execute([$category, 1]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch posts by search term
    public function searchPosts($searchTerm)
    {
        $stmt = $this->pdo->prepare("SELECT id, title, category, images, content FROM blogs WHERE title LIKE ? AND status = ? ORDER BY id DESC");
        $searchTerm = '%' . $searchTerm . '%';
        $stmt->execute([$searchTerm, 1]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch all posts with status 1
    public function getAllPosts()
    {
        $stmt = $this->pdo->prepare("SELECT id, title, category, images, content FROM blogs WHERE status = ? ORDER BY id DESC");
        $stmt->execute([1]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Display posts with limited content
    public function displayPosts($posts, $wordLimit = 30)
    {
        if ($posts): ?>
            <section id="introblocks">
                <ul class="nospace group">
                    <?php foreach ($posts as $post): ?>
                        <li class="one_third">
                            <figure>
                                <a class="imgover" href="post.php?id=<?php echo $post['id']; ?>">
                                    <img src="<?php echo htmlspecialchars($post['images']); ?>" alt="">
                                </a>
                                <figcaption>
                                    <h6 class="heading"><?php echo htmlspecialchars($post['title']); ?></h6>
                                    <div><?php echo $this->limitContent($post['content'], $wordLimit); ?></div>
                                </figcaption>
                            </figure>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php else: ?>
            <p>No posts available.</p>
        <?php endif;
    }

    // Fetch comments by post ID
    public function getCommentsByPostId($postId)
    {
        $stmt = $this->pdo->prepare("SELECT username, comment FROM comments WHERE post_id = ? ORDER BY time DESC");
        $stmt->execute([$postId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch posts by username
    public function getPostsByUsername($username)
    {
        $stmt = $this->pdo->prepare("SELECT id, title, category, images, content FROM blogs WHERE username = ? ORDER BY id DESC");
        $stmt->execute([$username]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch all user posts
    public function getAllUserPosts()
    {
        $stmt = $this->pdo->query("SELECT id, title, category, images, content, username, status FROM blogs ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
