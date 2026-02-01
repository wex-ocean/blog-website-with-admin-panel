<?php 
include 'partials/header.php';

// Featured post with category and author info
$featured_query = "SELECT p.*, c.title AS category_title, u.firstname, u.lastname, u.avatar 
                   FROM posts p 
                   JOIN categories c ON p.category_id = c.id 
                   JOIN users u ON p.author_id = u.id 
                   WHERE p.is_featured=1 LIMIT 1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

// 9 latest posts with category and author info (N+1 fix)
$query = "SELECT p.*, c.title AS category_title, u.firstname, u.lastname, u.avatar 
          FROM posts p 
          JOIN categories c ON p.category_id = c.id 
          JOIN users u ON p.author_id = u.id 
          WHERE p.is_featured=0 ORDER BY p.date_time DESC LIMIT 9";
$posts = mysqli_query($connection, $query);
?>

<?php if ($featured) : ?>
<section class="featured">
    <div class="container featured__container">            
        <div class="post__thumbnail">
            <img src="./images/<?= e($featured['thumbnail']) ?>">
        </div>
        <div class="post__info">
            <a href="category-posts.php?id=<?= $featured['category_id'] ?>" class="category__button"><?= e($featured['category_title']) ?></a>
            <h2 class="post__title"><a href="post.php?id=<?= $featured['id'] ?>"><?= e($featured['title']) ?></a></h2>
            <p class="post__body">
                <?= e(substr(html_entity_decode($featured['body']), 0, 300)) ?>...
            </p>
            <div class="post__author-avatar">
                <img src="./images/<?= e($featured['avatar']) ?>">
            </div>
            <div class="post__author-info">
                <h5>By: <?= e("{$featured['firstname']} {$featured['lastname']}") ?></h5>
                <small>
                    <?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?>
                </small>
            </div>
        </div>
    </div>
</section>
<?php endif ?> 
<!-- ===================END OF FEATURED================-->

<!-- #region POSTS -->
<section class="posts <?= $featured ? '' : 'section__extra-margin' ?>">
  <div class="container posts__container">
    <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
      <article class="post">
        <div class="post__thumbnail" style="width: 300px; height: 200px;">
          <img src="./images/<?= e($post['thumbnail']) ?>" >
        </div>
        <div class="post__info">
          <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $post['category_id'] ?>" class="category__button"><?= e($post['category_title']) ?></a>
          <h2 class="post__title"><a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= e($post['title']) ?></a></h2>
          <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>">
            <p class="post__body" style="min-height: 100px;">
              <?= e(substr(strip_tags(html_entity_decode($post['body'])), 0, 150)) ?>...
            </p>
          </a>
          <div class="post__author">
            <div class="post__author-avatar">
              <img src="./images/<?= e($post['avatar']) ?>" alt="" />
            </div>
            <div class="post__author-info">
              <h5>By: <?= e("{$post['firstname']} {$post['lastname']}") ?></h5>
              <small><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></small>
            </div>
          </div>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
</section>
<!-- #endregion POSTS -->




    <!--=====================================================================
    ==========================END OF THE POSTS===============================
  =================================================================== -->
  <section class="category__buttons">
    <div class="container category__buttons-container">
        <?php 
        $all_categories_query="SELECT * FROM categories ";
        $all_categories_result=mysqli_query($connection,$all_categories_query);

        ?>
        <?php while ( $category=mysqli_fetch_assoc($all_categories_result) ) : ?>
        <a href="<?=ROOT_URL?>category-posts.php?id=<?=$category['id']?>" class="category__button"><?=$category['title']?></a>
        <?php endwhile?>
    </div>
  </section>
  <!--=======================END OF CATEGORY ===================================-->
<?php
include './partials/footer.php';
?>