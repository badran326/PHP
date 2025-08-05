<?php
$pageTitle = "Register | Authentication Part Tow";
$pageDesc = "This page will allow the user to register to our application.";
require "templates/header.php";
require "./includes/database.php";
require "./includes/user.php";
require './includes/validate.php';
$valid = new validate();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $checkUsername = $valid->validUsername($username);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $checkPassword = $valid->validPassword($password);
    $confirm = $_POST['confirm'];
    /*$msg = $valid->checkEmpty($_POST, array('username', 'email', 'password', 'confirm'));*/
    $checkEmail = $valid->validEmail($email);
    $userprofile = '';
    $error = [];
    if (!empty($_FILES['userprofile']['name'])) {
        $userprofile = time() . '_' . basename($_FILES['userprofile']['name']);
        move_uploaded_file($_FILES['userprofile']['tmp_name'], "uploads/" . $userprofile);
    }
    if ($password !== $confirm) {
        $error[] = "Passwords do not match";
    }
    if ($checkEmail != 1){
        $error[] = "Email is not valid.\n Example for a valid email address: user@domain.com";
    }
    if ($checkUsername != 1) {
        $error[] = $checkUsername;
    }
    if (empty($error)) {
        $db = (new Database())->getConnection();
        $user = new User($db);
        if (empty($checkPassword)) {
            if ($user->register($email, $username, $password, $userprofile)) {
                header("Location: login.php");
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
            <label class="form-label">Email:
                <input type="email" name="email" class="form-control" required>
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
