<?php
$pageTitle = "Register | Authentication Part Tow";
$pageDesc = "This page will allow the user to register to our application.";
require "template/header.php";
require './inc/validate.php';
$valid = new validate();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $checkUsername = $valid->validUsername($username);
    $password = $_POST['password'];
    $checkPassword = $valid->validPassword($password);
    $confirm = $_POST['confirm'];
    /*$msg = $valid->checkEmpty($_POST, array('username', 'email', 'password', 'confirm'));*/
    $error = [];
    if ($password !== $confirm) {
        $error[] = "Passwords do not match";
    }
    if ($checkUsername != 1) {
        $error[] = $checkUsername;
    }
    if (empty($error)) {
        $db = (new db())->getConnection();
        $user = new User($db);
        if (empty($checkPassword)) {
            if ($user->register( $username, $password)) {
                header("Location: posts.php");
                exit;
            } else {
                $error[] = "Registration failed";
            }
        } else {
            $errors = $checkPassword;
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
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($error as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
<div class="container">
    <!-- the add.php will execute our CREATE function -->
    <form method="POST" class="register_form" enctype="multipart/form-data">
        <div class="errorMessageRow">
            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $e): ?>
                    <ul>
                        <li><?php echo $e; ?></li>
                    </ul>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
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
</div>
</main>
<?php require './template/footer.php'; ?>
