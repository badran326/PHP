<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        die("Access Denied!");
    }
    require "templates/loggedHeader.php";
    require "./includes/database.php";
    require "./includes/content.php";
    require './includes/validate.php';
    $db = (new Database())->getConnection();
    $content = new Content($db);
    $valid = new validate();
    $id = $_GET['id'];
    $c = $content->find($id);
    $user_id = $c['user_id'];
    $oldImg = $c['img'];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $msg = [];
        $msg = $valid->checkEmpty($_POST, array('name', 'coffee_type', 'temperature', 'size', 'sweeteners', 'flavored', 'content'));
        if (empty($msg)) {
            $name = $_POST['name'];
            $coffee_type = $_POST['coffee_type'];
            $temperature = $_POST['temperature'];
            $size = $_POST['size'];
            $sweeteners = $_POST['sweeteners'];
            $flavored = $_POST['flavored'];
            $img = '';
            $text = $_POST['content'];
            if (!empty($_FILES['img']['name'])) {
                $img = time() . '_' . basename($_FILES['img']['name']);
                move_uploaded_file($_FILES['img']['tmp_name'], "uploads/" . $img);
            } else {
                $img = $oldImg;
            }
            $db = (new Database()) ->getConnection();
            $content = new Content($db);
            if ($content->update($id, $user_id, $name, $text, $coffee_type, $temperature, $size, $sweeteners, $flavored, $img)) {
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Registration failed";
            }
        }
    }
    $found = $content->find($id);
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
        <form method="POST" enctype="multipart/form-data"  action="update.php?id=<?= $id ?>" class="review-form">
            <div class="coffee-shop">
                <label>Coffee Shop Name:
                    <input type="text" value="<?= $found['name'] ?>" name="name" placeholder="Coffee Shop Name">
                </label>
            </div>
            <div class="coffee-type">
                <label> Coffee Type:
                    <select name="coffee_type"  class="form-select">
                        <option value="<?= $found['coffee_type'] ?>"><?= $found['coffee_type'] ?></option>
                        <option value="">Select a drink type</option>
                        <option value="Espresso">Espresso</option>
                        <option value="Americano">Americano</option>
                        <option value="Latte">Latte</option>
                        <option value="Cappuccino">Cappuccino</option>
                        <option value="Macchiato">Macchiato</option>
                        <option value="Mocha">Mocha</option>
                    </select>
                </label>
            </div>
            <div class="checkboxes">
                <div class="form-check">
                    <input type="radio" <?php if ($found['temperature'] === 'Hot'): ?>checked <?php endif;?> name="temperature" value="Hot" class="form-check-input" id="hotOption">
                    <label class="form-check-label" for="hotOption">Hot</label>
                </div>
                <div class="form-check">
                    <input type="radio" <?php if ($found['temperature'] == 'Iced'): ?>checked <?php endif;?> name="temperature" value="Iced" class="form-check-input" id="icedOption">
                    <label class="form-check-label" for="icedOption">Iced</label>
                </div>
            </div>
            <div class="size">
                <label> Size:
                    <select name="size" class="form-select">
                        <option value="<?= $found['size'] ?>"><?= $found['size'] ?></option>
                        <option value="">Select a drink size</option>
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Large">Large</option>
                    </select>
                </label>
            </div>
            <div class="coffee-sweeteners">
                <label> Sweeteners:
                    <select name="sweeteners" class="form-select">
                        <option value="<?= $found['sweeteners'] ?>"><?= $found['sweeteners'] ?></option>
                        <option value="Sugar Free">Sugar Free</option>
                        <option value="Sugar">Sugar</option>
                        <option value="Brown Sugar">Brown Sugar</option>
                        <option value="Honey">Honey</option>
                        <option value="Sweeteners">Sweeteners</option>
                    </select>
                </label>
            </div>
            <div class="coffee-flavored">
                <label> Flavored:
                    <select name="flavored" class="form-select">
                        <option value="<?= $found['flavored'] ?>"><?= $found['flavored'] ?></option>
                        <option value="Non">Flavored Syrups</option>
                        <option value="Vanilla">Vanilla</option>
                        <option value="Caramel">Caramel</option>
                        <option value="Hazelnut">Hazelnut</option>
                        <option value="Chocolate">Chocolate</option>
                    </select>
                </label>
            </div>
            <div class="coffee-review">
                <label> Review:
                    <textarea name="content" placeholder="Review"><?= $found['content'] ?></textarea>
                </label>
            </div>
            <div class="coffee-img">
                <label> Coffee Image:
                    <input class="form-control" type="file" name="img">
                </label>
            </div>
            <button class="btn btn-primary" type="submit" name="Submit">Submit</button>
            <input class="btn btn-dark reset" type="reset" value="Clear">
        </form>
    </div>
</main>
<?php require './templates/footer.php'; ?>