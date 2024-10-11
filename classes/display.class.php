<?php
    class DisplayPosts 
    {
        private $pdo;

        public function __construct($dbConnection)
        {
            $this->pdo = $dbConnection;
        }

        public function getPostsByCategory($category)
        {
            $stmt = $this->pdo->prepare("SELECT id, title, category, images, content FROM blogs WHERE category = ? ORDER BY id DESC");
            $stmt->execute([$category]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function searchPosts($searchTerm)
        {
            $stmt = $this->pdo->prepare("SELECT id, title, category, images, content FROM blogs WHERE title LIKE ? ORDER BY id DESC");
            $searchTerm = '%' . $searchTerm . '%';
            $stmt->execute([$searchTerm]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAllPosts()
        {
            $stmt = $this->pdo->query("SELECT id, title, category, images, content FROM blogs ORDER BY id DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function displayPosts($posts)
        {
            if ($posts): ?>
                <section id="introblocks">
                    <ul class="nospace group">
                        <?php foreach ($posts as $post): ?>
                            <li class="one_third">
                                <figure>
                                    <a class="imgover" href="post.php?id=<?php echo $post['id'];?>">
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
                <p>No posts available.</p>
            <?php endif;
        }
        public function getCommentsByPostId($postId)
        {
            $stmt = $this->pdo->prepare("SELECT username, comment FROM comments WHERE post_id = ? ORDER BY time DESC");
            $stmt->execute([$postId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
