<?php
$pageTitle = "Register | Authentication Part Tow";
$pageDesc = "This page will allow the user to register to our application.";
require "templates/header.php";
require "./includes/database.php";
require "./includes/user.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $userprofile = '';
    if (!empty($_FILES['userprofile']['name'])) {
        $userprofile = time() . '_' . basename($_FILES['userprofile']['name']);
        move_uploaded_file($_FILES['userprofile']['tmp_name'], "uploads/" . $userprofile);
    }
    if ($password !== $confirm) {
        $error = "Passwords do not match";
    } else {
        $db = (new Database()) ->getConnection();
        $user = new User($db);
        if ($user->register($username, $password, $userprofile)) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Registration failed";
        }
    }
}
?>
<main class="register">
<section class="lesson-masthead">
    <h1>Register User</h1>
</section>
<div class="errorMessageRow">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
</div>
<div class="container">
    <!-- the add.php will execute our CREATE function -->
    <form method="POST" class="register_form" enctype="multipart/form-data">
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
        <div class="mb-3">
            <label class="form-label">Confirm Password:
                <input type="password" name="confirm" class="form-control" required>
            </label>
        </div>
        <div class="mb-3">
            <label class="form-label">Profile Picture:
                <input class="form-control" type="file" name="userprofile"><br>
            </label>
        </div>
        <button class="btn btn-primary" type="submit">Register</button>
        <a href="login.php" class="btn btn-secondary">Login</a>
    </form>
</div>
</main>
<?php require './templates/footer.php'; ?>
