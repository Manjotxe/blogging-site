<?php
    session_start();
    include('common/connection2.php');
    include('classes/display.class.php');
    if (isset($_SESSION['user'])) 
    {
        $username = $_SESSION['user'];
        // Create an instance of DisplayPosts
        $display = new DisplayPosts($pdo);

        // Fetch posts by the logged-in user
        $userPosts = $display->getPostsByUsername($username);
    } 
    else 
    {
        header('Location: login.php');
        exit();
    }
    
?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>ManjotsBlog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <style>
        .overlay 
        {
            background-image: url("images/demo/background.jpg");
        }
        .top 
        {
            background-image: url("images/demo/marbel.jpg");
            padding: 20px;
            color: #fff;
        }
        .post-container {
            display: flex; /* Create a flex container */
            align-items: flex-start; /* Align items to the top */
            padding: 20px; /* Add some padding */
        }

        .post-image 
        {
            flex: 0 0 400px; /* Slightly increased width for the image */
            margin-right: 0px; /* Space between image and content */
            margin-left: 103px; /* Adjusted left margin for image */
        }
        .post-content 
        {
            flex: 1; /* Take up the remaining space */
        }

        img 
        {
            max-width: 100%; /* Ensure the image does not overflow */
            height: auto; /* Maintain aspect ratio */
        }
        #pageintro
        {
            padding:20px 0;
        }
        #pageintro footer
        {
            margin-top:0;
        }
        #mainav .active a
        {
            color: #41C379;
        }
        .one_third
        {
            margin: 15px 15px 0 0px;
        }
        div 
        {
            word-wrap: break-word; 
            overflow-wrap: break-word; 
        }
    </style>
</head>
<body id="top">

<div class="bgded top"> 
    <header id="header" class="hoc clear"> 
        <div id="logo" class="one_quarter first">
            <h1><a href="index.html">MyBlog</a></h1>
            <p>Manjot's project</p>
        </div>
        <div class="three_quarter">
            <ul class="nospace clear">
                <li class="one_third first">
                    <div class="block clear"><a href="#"><i class="fas fa-phone"></i></a> <span><strong>Give us a call:</strong> +91 9876543210</span></div>
                </li>
                <li class="one_third">
                    <div class="block clear"><a href="#"><i class="fas fa-envelope"></i></a> <span><strong>Send us a mail:</strong> bloggermanjot@gmail.com</span></div>
                </li>
                <li class="one_third">
                    <div class="block clear"><a href="#"><i class="fas fa-clock"></i></a> <span><strong> Mon. - Sat.:</strong> 08.00am - 18.00pm</span></div>
                </li>
            </ul>
        </div>
    </header>

    <section id="navwrapper" class="hoc clear"> 
        <nav id="mainav">
            <ul class="clear">
                <li><a href="index.php">Home</a></li>
                <li class="active" ><a href="#">My Dashboard</a></li>
                <li><a class="drop" href="#">Categories</a>
                    <ul>
                        <li><a href="index.php?category=Clothes">Clothing</a></li>
                        <li><a href="index.php?category=Sports">Sports</a></li>
                        <li><a href="index.php?category=Electronics">Electronics</a></li>
                        <li><a href="index.php?category=Books">Books</a></li>
                        <li><a href="index.php?category=Furniture">Furniture</a></li>
                        <li><a href="index.php?category=Accessories">Accessories</a></li>
                    </ul>
                </li>
                <li><a href="#">Privacy and Policies</a></li>
                <li><a href="admin-login.php">Admin Login</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
                <li>
                    <?php if(empty($_SESSION['user'])) { ?>
                        <a href="login.php">Log in!!</a>
                    <?php } else { ?>
                        <a href="index.php?log=1">Logout <?php echo $_SESSION['user'] ?></a>
                    <?php } ?>
                </li>
            </ul>
        </nav>

        <div id="searchform">
            <div>
                <form action="" method="get">
                    <fieldset>
                        <legend>Quick Search:</legend>
                        <input type="text" name="search" placeholder="Enter search term&hellip;">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </fieldset>
                </form>
            </div>
        </div>
    </section>
    <div id="pageintro" class="hoc clear"> 
        <article>
        <p>My Blogs</p>
        <p>You can add posts here for review from admin.</p>
        <footer><a class="btn" href="addpost.php">Add a Post.....</a></footer>
        </article>
        <section id="user-posts">
        <?php if ($userPosts): ?>
            <?php foreach ($userPosts as $post): ?>
                <div class="post">
                <li class="one_third">
                    <figure>
                        <a class="imgover" href="post.php?id=<?php echo $post['id'];?>">
                            <img src="<?php echo htmlspecialchars($post['images']); ?>" alt="">
                        </a>
                        <figcaption>
                            <h2 class=""><?php echo htmlspecialchars($post['title']); ?></h2>
                            <div>
                                <?php
                                // Limit the content to 30 words
                                $content = strip_tags($post['content']);
                                $words = explode(' ', $content);
                                $limitedContent = implode(' ', array_slice($words, 0, 10));
                                echo $limitedContent . '...'; // Display limited content
                                ?>
                            </div>
                        </figcaption>
                    </figure>
                </li>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No posts available.</p>
        <?php endif; ?>
    </section>
    </div>
</div>

<div class="bgded overlay row4">
    <footer id="footer" class="hoc clear"> 
        <div class="center btmspace-50">
            <h6 class="heading">Manjot's Blog</h6>
            <ul class="faico clear">
                <li><a class="faicon-dribble" href="#"><i class="fab fa-dribbble"></i></a></li>
                <li><a class="faicon-facebook" href="#"><i class="fab fa-facebook"></i></a></li>
                <li><a class="faicon-google-plus" href="#"><i class="fab fa-google-plus-g"></i></a></li>
                <li><a class="faicon-linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
                <li><a class="faicon-twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a class="faicon-instagram" href="#"><i class="fab fa-instagram"></i></a></li>
            </ul>
            <p class="nospace">Stay connected with us on social media for updates, news, and exclusive content!</p>
        </div>
        <hr class="btmspace-50">
        <div class="one_quarter first">
            <h6 class="heading">About Us</h6>
            <p class="nospace btmspace-15">Manjot's Blog is your one-stop destination for all the latest news, reviews, and trends across a variety of topics. We are dedicated to bringing you high-quality content that informs and inspires.</p>
            <p><a href="#">Learn More &raquo;</a></p>
        </div>
        <div class="one_quarter">
            <h6 class="heading">Quick Links</h6>
            <ul class="nospace linklist">
                <li><a href="#">Home</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">Categories</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
        <div class="one_quarter">
            <h6 class="heading">Support</h6>
            <ul class="nospace linklist">
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Customer Support</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Return Policy</a></li>
                <li><a href="#">Accessibility</a></li>
            </ul>
        </div>
        <div class="one_quarter">
            <h6 class="heading">Newsletter</h6>
            <p class="nospace btmspace-15">Subscribe to our newsletter for the latest updates and special offers directly in your inbox.</p>
            <form action="#" method="post">
                <fieldset>
                    <legend>Subscribe:</legend>
                    <input class="btmspace-15" type="text" value="" placeholder="Email Address">
                    <button type="submit" value="submit">Subscribe</button>
                </fieldset>
            </form>
        </div>
    </footer>
</div>

<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<script src="js/share.js"></script>
</body>
</html>
