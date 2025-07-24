<?php
    $pageTitle = "Home";
    $pageDec = "This page will allow user to add the review order";
    require './templates/header.php';
?>
<main class="index">
    <div class="container">
        <section class="login_text">
            <h1>LogIn to The Coffee World</h1>
        </section>
        <section class="buttons">
            <div class="btn login-btn">
                <a href="login.php">Login</a>
            </div>
            <div class="btn register-btn">
                <a href="register.php">Register</a>
            </div>
        </section>
    </div>
</main>
<?php
    require './templates/footer.php';
?>