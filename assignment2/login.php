<?php
    session_start();
    $pageTitle = "Login";
    $pageDesc = "This page will allow the user to login to our application.";
    require "templates/header.php";
    require "./includes/database.php";
    require "./includes/user.php";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $db = (new Database())->getConnection();
        $user = new User($db);
        $login = $user->login($_POST["username"], $_POST["password"]);
        if ($login) {
            $_SESSION["user_id"] = $login['id'];
            $_SESSION["username"] = $login['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid Login";
        }
    }
?>

<main class="login">
    <section class="errorMessageRow">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
    </section>
    <section class="container">
        <!-- the add.php will execute our CREATE function -->
        <form method="POST" class="login_form">
            <!-- I am using the wrong input types so that we can test our php validation with no road blocks -->
            <div class="mb-3">
                <label class="form-label">Username:
                    <input type="text" name="username" class="form-control" required>
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label">Password:
                    <input type="password" name="password" class="form-control" required>
                </label>
            </div>
            <button class="btn btn-primary" type="submit">Login</button>
            <a href="register.php" class="btn btn-secondary">Register</a>
        </form>
    </section>
</main>
<?php
    require './templates/footer.php';
?>