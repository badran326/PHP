<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        die("Access Denied!");
    }
    require "templates/header.php";
    require "./includes/database.php";
    require "./includes/user.php";
    $db = (new Database())->getConnection();
    $user = new User($db);
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $user->update($_POST['id'], $_POST['username']);
        header('Location: dashboard.php');
        exit;
    }
    $found = $user->find($_GET['id']);
?>
    <section class="lesson-masthead">
        <h1>Edit User</h1>
    </section>
    <section class="container">
        <form method="POST" class="w-50 register_form">
            <input type="hidden" name="id" value="<?= $found['id'] ?>">
            <div class="mb-3">
                <label class="form-label">Username:
                    <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($found['username']) ?>" required>
                </label>
            </div>
            <button class="btn btn-success">Save</button>
            <a href="dashboard.php" class="btn btn-secondary">Back</a>
        </form>
    </section>
<?php require './templates/footer.php'; ?>