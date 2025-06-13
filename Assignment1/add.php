<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD in OOP PHP | Add Our Data</title>
    <meta name="description" content="This week we will be using OOP PHP to create and read with our CRUD application">
    <meta name="robots" content="noindex, nofollow">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="./css/style.css">
    <!-- Latest compiled and minified JavaScript -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
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
    <?php
        // start by including our classes
        include_once ("crud.php");
        include_once ("validate.php");
        // creat our class objects
        $crud = new crud();
        $valid = new validate();
        if (isset($_POST['Submit'])) {
            $name = $crud->escape_string($_POST['name']);
            $count = $crud->escape_string($_POST['count']);
            $coffee_type = $crud->escape_string($_POST['coffee_type']);
            $temperature = $crud->escape_string($_POST['temperature']);
            $size = $crud->escape_string($_POST['size']);
            $milk_option = $crud->escape_string($_POST['milk_options']);
            $sweeteners = $crud->escape_string($_POST['sweeteners']);
            $flavored_syrups = $crud->escape_string($_POST['flavored_syrups']);
            // using our function found in our validate class (checkEmpty validAge validEmail)
            $fields = ['name', 'count', 'coffee_type', 'temperature', 'size', 'milk_options', 'sweeteners', 'flavored_syrups'];
            $msg = $valid->checkEmpty($_POST, $fields);
            $checkCount = $valid->validCount($_POST['count']);
            if ($msg != null){
                echo "<p>$msg</p>";
                // Link to the previous page
                echo "<a href='javascript:history.back();'>Go Back</a>";
            } elseif (!$checkCount) {
                echo "<p>Pleas provide a valid age</p>";
                echo "<a href='javascript:history.back();'>Go Back</a>";
            } else {
                $query = "INSERT INTO
                assignment1 (name, count, coffee_type, temperature, size, milk_option, sweeteners, flavored_syrups)
                VALUES
                ('$name', '$count', '$coffee_type', '$temperature', '$size', '$milk_option', '$sweeteners', '$flavored_syrups')";
                $result = $crud->execute($query);

                echo "<p>Record has been added successfully</p>";
                echo "<p><a href='index.php'>Order again</a></p>";
                echo "<p><a href='view.php'>View Orders</a></p>";
            }
        } else {
            echo "<p>Please fill in all the fields</p>";
        }
    ?>
</main>
<footer>
    <?php
    require './includes/footer.php';
    ?>
</footer>
</body>
</html>