<?php 
include 'partials/header.php';

// Fetch post from database if id is set
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT p.*, u.firstname, u.lastname, u.avatar 
              FROM posts p 
              JOIN users u ON p.author_id = u.id 
              WHERE p.id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);

    if (!$post) {
        header('location: ' . ROOT_URL . 'blog.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}
?>

<section class="singlepost">
    <div class="container singlepost__container">
        <h2>
            <?= e($post['title']) ?>
        </h2>
        <div class="post__author">
            <div class="post__author-avatar">
                <img src="./images/<?= e($post['avatar']) ?>">
            </div>
            <div class="post__author-info">
                <h5>By: <?= e("{$post['firstname']} {$post['lastname']}") ?></h5>
                <small>
                    <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                </small>
            </div>
        </div>
        <div class="singlepost__thumbnail">
            <img src="./images/<?= e($post['thumbnail']) ?>" >
        </div>
        <p><?= e($post['body']) ?></p>
    </div>
</section>

<?php
include './partials/footer.php';
?>