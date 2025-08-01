 <?php
     session_start();
     if(!isset($_SESSION['user_id'])){
         require './templates/header.php';
     } else {
         require './templates/loggedHeader.php';
     }
    require './includes/database.php';
    require './includes/content.php';
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_SESSION['user_id'];
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
        }
        $db = (new Database()) ->getConnection();
        $content = new Content($db);
        if ($content->addReview($user_id, $name, $coffee_type, $temperature, $size, $sweeteners, $flavored, $img, $text)) {
            header("Location: dashboard.php");
            exit;
            } else {
            $error = "Registration failed";
        }
    }
?>
<main class="review">
    <div class="container">
        <!-- the add.php will execute our CREATE function -->
        <form method="POST" enctype="multipart/form-data"  action="review.php" class="review-form">
            <!-- I am using the wrong input types so that we can test our php validation with no road blocks -->
            <div class="coffee-shop">
                <label>Coffee Shop Name:
                    <input type="text" name="name" placeholder="Coffee Shop Name">
                </label>
            </div>
            <div class="coffee-type">
                <label> Coffee Type:
                    <select name="coffee_type" class="form-select">
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
                    <input type="radio" name="temperature" value="Hot" class="form-check-input" id="hotOption">
                    <label class="form-check-label" for="hotOption">Hot</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="temperature" value="Iced" class="form-check-input" id="icedOption">
                    <label class="form-check-label" for="icedOption">Iced</label>
                </div>
            </div>
            <div class="size">
                <label> Size:
                    <select name="size" class="form-select">
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
                        <option value="Free sugar">Sweeteners</option>
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
                    <textarea name="content" placeholder="Review"></textarea>
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
<?php
    require './templates/footer.php';
?>