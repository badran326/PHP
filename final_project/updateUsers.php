<?php
session_start();
if(!isset($_SESSION['user_id'])){
    die("Access Denied!");
}
require "templates/loggedHeader.php";
require "./includes/database.php";
require "./includes/user.php";
require "./includes/validate.php";
$db = (new Database())->getConnection();
$user = new User($db);
$valid = new validate();
$user_id = $_GET['id'];
$u = $user->find($user_id);
$oldImg = $u['userprofile'];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $checkUsername = $valid->validUsername($username);
    $email = $_POST['email'];
    $checkEmail = $valid->validEmail($email);
    $userprofile = '';
    $errors = [];
    if ($checkUsername != 1) {
        $errors[] = $checkUsername;
    }
    if ($checkEmail != 1) {
        $errors[] = "Email is not valid.\n Example for a valid email address: user@domain.com";
    }
    if (empty($errors)) {
        if (!empty($_FILES['userprofile']['name'])) {
            $userprofile = time() . '_' . basename($_FILES['userprofile']['name']);
            move_uploaded_file($_FILES['userprofile']['tmp_name'], "uploads/" . $userprofile);
        } else {
            $userprofile = $oldImg;
        }
        if ($user->update($user_id, $username, $email, $userprofile)) {
            header("Location: dashboard.php");
            exit;
        } else {
            $errors[] = "Registration failed";
        }
    }
}
?>
    <main class="register">
        <section class="lesson-masthead">
            <h1>Register User</h1>
        </section>
        <div class="errorMessageRow">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <div class="container">
            <!-- the add.php will execute our CREATE function -->
            <form method="POST" class="register_form" enctype="multipart/form-data">
                <!-- I am using the wrong input types so that we can test our php validation with no road blocks -->
                <div class="mb-3">
                    <label class="form-label">
                        <input hidden="hidden" disabled type="text" value="<?= htmlspecialchars($u['user_id']) ?>" name="username" class="form-control" required>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username:
                        <input type="text" value="<?= htmlspecialchars($u['username']) ?>" name="username" class="form-control" required>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:
                        <input type="email" value="<?= htmlspecialchars($u['email']) ?>"  name="email" class="form-control" required>
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