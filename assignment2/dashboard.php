<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('Location: index.php');
        exit;
    }
    $pageTitle = "Dashboard";
    $pageDesc = "This page display list of registered users";
    require "templates/loggedHeader.php";
    require "./includes/database.php";
    require "./includes/user.php";
    require './includes/content.php';
    $db = (new Database())->getConnection();
    $user = new User($db);
    $content = new Content($db);
    $users = $user->getAll();
    $contents = $content->getAll();
?>
<main class="dashboard">
    <div class="container">
      <section class="lesson-masthead">
        <h1>Content Page</h1>
      </section>
        <?php foreach ($contents as $c): ?>
            <section class="review-post">
                <div class="review-img">
                    <img src="./uploads/<?=$c['img']?>" alt="post img">
                </div>
                <div class="review-details">
                    <h5>Coffee Shop Name: <?=$c['name']?></h5>
                    <h5>Drink: <?=$c['coffee_type']?></h5>
                    <h5>Temperature: <?=$c['temperature']?></h5>
                    <h5>Size: <?=$c['size']?></h5>
                    <h5>Sweeteners: <?=$c['sweeteners']?></h5>
                    <h5>Flavor: <?=$c['flavored']?></h5>
                </div>
                <div class="review-text">
                    <p><?= $c['content'] ?></p>
                </div>
                <div class="review-btn">
                    <a class="btn btn-sm btn-primary" href="update.php?id=<?= $c['id'] ?>">Edit</a>
                    <a class="btn btn-sm btn-danger" href="delete.php?id=<?= $c['id'] ?>" onclick=" confirm('Are you sure?')">Delete</a>
                </div>
            </section>
        <?php endforeach; ?>
      <!--<section class="userList">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Username</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php /* foreach ($users as $u): ?>
              <tr>
                <td><?= $u['user_id'] ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td>
                  <a class="btn btn-sm btn-primary" href="update.php?id=<?= $u['user_id'] ?>">Edit</a>
                  <a class="btn btn-sm btn-danger" href="delete.php?id=<?= $u['user_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
              </tr>
            <?php endforeach; */?>
          </tbody>
        </table>
      </section>
    </div>
</main>
<?php require './templates/footer.php'; ?>