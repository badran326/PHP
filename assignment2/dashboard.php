<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
        exit;
    }
    $pageTitle = "Dashboard";
    $pageDesc = "This page display list of registered users";
    require "templates/header.php";
    require "./includes/database.php";
    require "./includes/user.php";
    $db = (new Database())->getConnection();
    $user = new User($db);
    $users = $user->getAll();
?>
<main class="dashboard">
    <div class="container">
      <section class="lesson-masthead">
        <h1>View Users</h1>
      </section>
      <section class="welcomeMessage">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
        <a href="logout.php" class="btn btn-danger mb-3">Logout</a>
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
              <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td>
                  <a class="btn btn-sm btn-primary" href="update.php?id=<?= $u['id'] ?>">Edit</a>
                  <a class="btn btn-sm btn-danger" href="delete.php?id=<?= $u['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </section>
    </div>
</main>
<?php require './templates/footer.php'; ?>