<?php
    session_start();
    $pageTitle = "Login";
    $pageDesc = "This page will allow the user to login to our application.";
    require "templates/header.php";
    require "./includes/database.php";
    require "./includes/user.php";
    require './includes/content.php';
    $db = (new Database())->getConnection();
    $content = new Content($db);
    $contents = $content->getAll();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $user = new User($db);
        $login = $user->login($_POST["email"], $_POST["password"]);
        if ($login) {
            $_SESSION["user_id"] = $login['user_id'];
            $_SESSION["email"] = $login['email'];
            $_SESSION["username"] = $login['username'];
            $_SESSION["userprofile"] = $login['userprofile'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid Login";
        }
    }
?>
<main class="dashboard">
    <div class="container">
        <section class="lesson-masthead">
            <?php if (!empty($error)){ ?>
            <p id="errorMessageRow" class="errorMessageRow"><?= $error?></p>
            <?php } ?>
            <h1>View Reviews</h1>
        </section>
        <?php foreach ($contents as $c): ?>
            <section class="review-post">
                <div class="review-img">
                    <img src="./uploads/<?=$c['img']?>" alt="post img">
                </div>
                <div class="review-details">
                    <h5>Coffee Name: <?=$c['name']?></h5>
                    <h5>Drink Name: <?=$c['coffee_type']?></h5>
                    <h5>Temperature: <?=$c['temperature']?></h5>
                    <h5>Size: <?=$c['size']?></h5>
                    <h5>Sweeteners: <?=$c['sweeteners']?></h5>
                    <h5>Flavor: <?=$c['flavored']?></h5>
                </div>
                <div class="review-text">
                    <p><?= $c['content'] ?></p>
                </div>
                <div class="review-btn">
                    <a class="btn btn-sm btn-primary" onclick="alert('LogIn to be able to edit')" href="login.php">Edit</a>
                    <a class="btn btn-sm btn-danger" onclick="alert('LogIn to be able to delete')" href="login.php">Delete</a>
                </div>
            </section>
        <?php endforeach; ?>
    </div>
</main>
<?php require './templates/footer.php'; ?>
