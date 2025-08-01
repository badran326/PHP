<?php
$pageTitle = "Home";
$pageDec = "This page will allow user to add the review order";
require './templates/header.php';
require "./includes/database.php";
require './includes/content.php';
$db = (new Database())->getConnection();
$content = new Content($db);
$contents = $content->getAll();
?>
    <main class="dashboard">
        <div class="container">
            <section class="lesson-masthead">
                <h1>View Reviews</h1>
            </section>
            <?php foreach ($contents as $c): ?>
                <section class="review-post">
                    <div class="review-img">
                        <img src="./uploads/<?=$c['img']?>" alt="post img">
                    </div>
                    <div class="review-details">
                        <h5>Coffee Name: <?=$c['coffee_type']?></h5>
                        <h5>Drink Name: <?=$c['coffee_type']?></h5>
                        <h5>Temperature: <?=$c['temperature']?></h5>
                        <h5>Size: <?=$c['size']?></h5>
                        <h5>Sweeteners: <?=$c['sweeteners']?></h5>
                        <h5>Flavor: <?=$c['flavored']?></h5>
                    </div>
                    <div class="review-text">
                        <p><?= $c['content'] ?></p>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
    </main>
<?php require './templates/footer.php'; ?>