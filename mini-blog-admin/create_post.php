<?php
require './template/header.php';
require './inc/blog_admin.php';
require './inc/validate.php';
$valid = new validate();
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
        }
        $db = (new db()) ->getConnection();
        $blog = new BlogAdmin($db);
        if ($blog->addBlog($title, $content, $img)) {
            header("Location: posts.php");
            exit;
        } else {
            $error = "Adding blog failed";
        }
    }
}
?>
    <main class="register">
        <section class="lesson-masthead">
            <h1>Add Blog</h1>
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
                    <label class="form-label">Title:
                        <input type="text" name="title" class="form-control" required>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Content:
                        <textarea name="content" class="form-control" required></textarea>
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
<?php
require './template/footer.php';
?>