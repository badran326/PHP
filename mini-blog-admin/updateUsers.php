<?php
session_start();
if(!isset($_SESSION['user_id'])){
    die("Access Denied!");
}
require "template/loggedHeader.php";
require "./inc/db.php";
require "./inc/user.php";
require "./inc/validate.php";
$db = (new db())->getConnection();
$user = new User($db);
$valid = new validate();
$user_id = $_GET['id'];
$u = $user->find($user_id);
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $checkUsername = $valid->validUsername($username);
    $errors = [];
    if ($checkUsername != 1) {
        $errors[] = $checkUsername;
    }
    if (empty($errors)) {
        if ($user->update($user_id, $username)) {
            header("Location: posts.php");
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
                <button class="btn btn-primary" type="submit">Update</button>
                <a href="index.php" class="btn btn-secondary">Login</a>
            </form>
        </div>
    </main>
<?php require './templates/footer.php'; ?>