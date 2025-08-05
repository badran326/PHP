<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: index.php');
    exit;
}
$pageTitle = "Users";
$pageDesc = "This page display list of Users";
require "templates/loggedHeader.php";
require "./includes/database.php";
require "./includes/user.php";
$db = (new Database())->getConnection();
$user = new User($db);
$users = $user->getAll();
?>
    <main class="users">
        <div class="container">
            <section class="lesson-masthead">
                <h1>Content Page</h1>
            </section>
            <section class="userList">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Actions</th>
                        <th>Profile Picture</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr class="user">
                            <td class="id"><?= $u['user_id'] ?></td>
                            <td class="name"><?= htmlspecialchars($u['username']) ?></td>
                            <td class="actions">
                                <a class="btn btn-sm btn-primary" href="updateUsers.php?id=<?= $u['user_id'] ?>">Edit</a>
                                <a class="btn btn-sm btn-danger" href="delete.php?id=<?= $u['user_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                            <td class="img">
                                <img src="./uploads/<?= $u['userprofile'] ?>" alt="User Profile">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
<?php require './templates/footer.php'; ?>