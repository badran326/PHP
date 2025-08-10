<?php
session_start();
if(!isset($_SESSION['user_id'])){
    die("Access Denied!");
}
require "template/header.php";
require "./inc/blog_admin.php";
require './inc/validate.php';
$db = (new db())->getConnection();
$blog = new BlogAdmin($db);
$valid = new validate();
$id = $_GET['id'];
$c = $blog->getBlog($id);
$oldImg = $c['image'];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $msg = [];
    $msg = $valid->checkEmpty($_POST, array('title', 'content'));
    if (empty($msg)) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $img = '';
        if (!empty($_FILES['image']['name'])) {
            $img = time() . '_' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $img);
        } else {
            $img = $oldImg;
        }
        $db = (new db()) ->getConnection();
        $blog = new BlogAdmin($db);
        if ($blog->updateBlog($id, $title, $content, $img)) {
            header("Location: posts.php");
            exit;
        } else {
            $error = "Registration failed";
        }
    }
}
$found = $blog->getBlog($id);
?>
    <main class="review">
        <div class="container">
            <!-- the add.php will execute our CREATE function -->
            <div class="row">
                <?php if (!empty($msg)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($msg as $err): ?>
                                <li><?= htmlspecialchars($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
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
                    <label class="form-label">Title:
                        <input type="text" value="<?= $found['title'] ?>" name="title" class="form-control" required>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Content:
                        <textarea name="content" class="form-control" required><?= $found['content'] ?></textarea>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image:
                        <input class="form-control" type="file" name="image"><br>
                    </label>
                </div>
                <button class="btn btn-primary" type="submit" name="Submit">Submit</button>
                <input class="btn btn-dark reset" type="reset" value="Clear">
            </form>
        </div>
    </main>
<?php require './template/footer.php'; ?>