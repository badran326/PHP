<?php
session_start();
if(!isset($_SESSION['user_id'])){
    require "./template/header.php";
} else {
    require './template/loggedHeader.php';
    require './inc/db.php';
}
$pageTitle = "Posts";
$pageDesc = "This page display list of registered users";
require './inc/blog_admin.php';
$db = (new db())->getConnection();
$content = new BlogAdmin($db);
$contents = $content->getBlogs();
?>
    <main class="dashboard">
        <div class="container">
            <section class="lesson-masthead">
                <h1>Content Page</h1>
            </section>
            <?php foreach ($contents as $c): ?>
                <?php $b = $content->getBlog($c['id']);?>
                <section class="review-post">
                    <div class="review-img">
                        <img src="./uploads/<?=$c['image']?>" alt="post img">
                    </div>
                    <div class="review-details">
                        <h5>Title: <?=$c['title']?></h5>
                    </div>
                    <div class="review-text">
                        <p><?= $c['content'] ?></p>
                    </div>
                    <div class="review-btn">
                        <a class="btn btn-sm btn-primary" href="edit_post.php?id=<?= $c['id'] ?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="delete_post.php?id=<?= $c['id'] ?>" onclick=" confirm('Are you sure?')">Delete</a>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
    </main>
<?php require './template/footer.php'; ?>