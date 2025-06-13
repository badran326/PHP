<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRUD in OOP PHP | Read</title>
	<meta name="description" content="This week we will be using OOP PHP to create our CRUD application">
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
<div class="container">
	<div class="row">
		<table class="table">
            <?php
            include 'crud.php';
            $crud = new crud();
            $query = "SELECT * FROM assignment1";
            $result = $crud->getData($query);
            ?>
      <!-- add our table headings -->
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Count</th>
                <th scope="col">Coffee Type</th>
                <th scope="col">Temperature</th>
                <th scope="col">size</th>
                <th scope="col">Milk Type</th>
                <th scope="col">Sweetener</th>
                <th scope="col">Flavored</th>
              </tr>
            </thead>
            <?php
            foreach ($result as $key => $res) {
                echo "<tr>";
                    echo "<td>" . $res['name'] . "</td>";
                    echo "<td>" . $res['count'] . "</td>";
                    echo "<td>" . $res['coffee_type'] . "</td>";
                    echo "<td>" . $res['temperature'] . "</td>";
                    echo "<td>" . $res['size'] . "</td>";
                    echo "<td>" . $res['milk_option'] . "</td>";
                    echo "<td>" . $res['sweeteners'] . "</td>";
                    echo "<td>" . $res['flavored_syrups'] . "</td>";
                echo "</tr>";
            }
            ?>

		</table>
	</div>
</div>
<footer>
    <?php
    require './includes/footer.php'
    ?>
</footer>
</body>
</html>
