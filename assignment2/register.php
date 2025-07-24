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
    if ($password !== $confirm) {
        $error = "Passwords do not match";
    } else {
        $db = (new Database()) ->getConnection();
        $user = new User($db);
        if ($user->register($username, $password)) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Registration failed";
        }
    }
}
?>
<section class="lesson-masthead">
    <h1>Register User</h1>
</section>
<section class="errorMessageRow">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
</section>
<section class="container">
    <!-- the add.php will execute our CREATE function -->
    <form method="POST" class="register_form">
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
        <button class="btn btn-primary" type="submit">Register</button>
        <a href="login.php" class="btn btn-secondary">Login</a>
    </form>
</section>
<?php require './templates/footer.php'; ?>
