
<footer>
    <div class="footer__socials">
        <a href="https://www.youtube.com/channel/UCvtrqmex9f7J9hxZfmhoHRw" target="_blank"><i class="uil uil-youtube"></i></a>
        <a href="https://www.instagram.com/_underemployed_/" target="_blank"><i class="uil uil-instagram-alt"></i></a>
        <a href="https://www.linkedin.com/in/nithin-a-06b946256/" target="_blank"><i class="uil uil-linkedin"></i></a> 
        <a href="" target="_blank"><i class="uil uil-facebook-f"></i></a> 
    </div>
    <div class="container footer__container">
        <article>
            <h4>Categories</h4>
            <ul>
                <?php 
                $footer_categories_query = "SELECT * FROM categories LIMIT 6";
                $footer_categories_result = mysqli_query($connection, $footer_categories_query);
                while($category = mysqli_fetch_assoc($footer_categories_result)) : 
                ?>
                <li><a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>"><?= $category['title'] ?></a></li>
                <?php endwhile ?>
            </ul>
        </article>
        <article>
            <h4>Support</h4>
            <ul>
                <li><a href="<?= ROOT_URL ?>contact.php">Contact Us</a></li>
                <li><a href="mailto:contact@underemployed.com">Email Support</a></li>
                <li><a href="tel:+15551234567">Call Us</a></li>
                <li><a href="<?= ROOT_URL ?>about.php">About Us</a></li>
                <li><a href="<?= ROOT_URL ?>services.php">Our Services</a></li>
            </ul>
        </article>

        <article>
            <h4>Quick Links</h4>
            <ul>
                <li><a href="<?= ROOT_URL ?>blog.php">All Posts</a></li>
                <li><a href="<?= ROOT_URL ?>search.php">Search</a></li>
                <li><a href="<?= ROOT_URL ?>signin.php">Sign In</a></li>
                <li><a href="<?= ROOT_URL ?>signup.php">Sign Up</a></li>
                <?php if(isset($_SESSION['user-id'])) : ?>
                <li><a href="<?= ROOT_URL ?>admin/index.php">Dashboard</a></li>
                <?php endif ?>
            </ul>
        </article>

        <article>
            <h4>Navigation</h4>
            <ul>
                <li><a href="<?= ROOT_URL ?>index.php">Home</a></li>
                <li><a href="<?= ROOT_URL ?>blog.php">Blog</a></li>
                <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
                <li><a href="<?= ROOT_URL ?>services.php">Services</a></li>
                <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
            </ul>
        </article>
    </div>

    <div class="footer__copyright">
        <small>Copyright &copy; UnderEmployed</small>
    </div>
  </footer>


  <script src="<?= ROOT_URL ?>js/main.js"></script>
</body>
</html>


