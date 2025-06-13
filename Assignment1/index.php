<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD in OOP PHP | Create & Read</title>
    <meta name="description" content="This week we will be using OOP PHP to create and read with our CRUD application">
    <meta name="robots" content="noindex, nofollow">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="./css/style.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>
<body>
<header>
<?php
require './includes/header.php';
?>
</header>
<main class="container">
    <section class="form-row row justify-content-center">
        <!-- the add.php will execute our CREATE function -->
        <form method="post" action="add.php" class="form-horizontal col-md-6 col-md-offset-3">
            <!-- I am using the wrong input types so that we can test our php validation with no road blocks -->
            <p><input type="text" name="name" placeholder="Your Name"></p>
            <p><input type="number" name="count" placeholder="Count"></p>
            <p>
                <select name="coffee_type" class="form-select">
                    <option value="">Select a drink type</option>
                    <option value="Espresso">Espresso</option>
                    <option value="Americano">Americano</option>
                    <option value="Latte">Latte</option>
                    <option value="Cappuccino">Cappuccino</option>
                    <option value="Macchiato">Macchiato</option>
                    <option value="Mocha">Mocha</option>
                </select>
            </p>
                <div class="form-check">
                    <input type="radio" name="temperature" value="Hot" class="form-check-input" id="hotOption">
                    <label class="form-check-label" for="hotOption">Hot</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="temperature" value="Iced" class="form-check-input" id="icedOption">
                    <label class="form-check-label" for="icedOption">Iced</label>
                </div>
            <p>
                <select name="size" class="form-select">
                    <option value="">Select a drink size</option>
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                </select>
            </p>
            <p>
                <select name="milk_options" class="form-select">
                    <option value="Non">Milk Options</option>
                    <option value="Whole">Whole</option>
                    <option value="semi">semi</option>
                    <option value="Skim">Skim</option>
                    <option value="Almond">Almond</option>
                    <option value="Oat">Oat</option>
                    <option value="Coconut">Coconut</option>
                    <option value="Soy">Soy</option>
                </select>
            </p>
            <p>
                <select name="sweeteners" class="form-select">
                    <option value="Free sugar">Sweeteners</option>
                    <option value="Sugar">Sugar</option>
                    <option value="Brown Sugar">Brown Sugar</option>
                    <option value="Honey">Honey</option>
                    <option value="Sweeteners">Sweeteners</option>
                </select>
            </p>
            <p>
                <select name="flavored_syrups" class="form-select">
                    <option value="Non">Flavored Syrups</option>
                    <option value="Vanilla">Vanilla</option>
                    <option value="Caramel">Caramel</option>
                    <option value="Hazelnut">Hazelnut</option>
                    <option value="Chocolate">Chocolate</option>
                </select>
            </p>
            <input class="btn btn-primary order" type="submit" name="Submit" value="Add">
            <input class="btn btn-dark reset" type="reset" value="Clear">
        </form>
    </section>
</main>
<footer>
   <?php
    require './includes/footer.php';
    ?> 
</footer>
</body>
</html>