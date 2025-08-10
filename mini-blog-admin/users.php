<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
}
$pageTitle = "Users";
$pageDesc = "This page display list of Users";
require "template/loggedHeader.php";
require './inc/db.php';
require './inc/user.php';
$db = (new db())->getConnection();
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr class="user">
                            <td class="id"><?= $u['user_id'] ?></td>
                            <td class="name"><?= htmlspecialchars($u['username']) ?></td>
                            <td class="actions">
                                <a class="btn btn-sm btn-primary" href="updateUsers.php?id=<?= $u['user_id'] ?>">Edit</a>
                                <a class="btn btn-sm btn-danger" href="delete_post.php?id=<?= $u['user_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
<?php require './template/footer.php'; ?>