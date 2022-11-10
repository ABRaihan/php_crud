<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Add Data</title>
</head>

<body>

<?php
//including the database connection file
include_once("config.php");
if(isset($_POST['submit'])) {
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$price = mysqli_real_escape_string($mysqli, $_POST['price']);
	$category = mysqli_real_escape_string($mysqli, $_POST['category']);
	$brand = mysqli_real_escape_string($mysqli, $_POST['brand']);
	$stockStatus = mysqli_real_escape_string($mysqli, $_POST['stockStatus']);
	$img = mysqli_real_escape_string($mysqli, $_POST['img']);
	// checking empty fields
	if(empty($name) || empty($price) || empty($category) || empty($brand)) {

		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}

		if(empty($price)) {
			echo "<font color='red'>Price field is empty.</font><br/>";
		}

		if(empty($category)) {
			echo "<font color='red'>Category field is empty.</font><br/>";
		}
		if(empty($brand)) {
			echo "<font color='red'>Brand field is empty.</font><br/>";
		}
		header('Refresh: 2; URL=http://localhost:8080/add.html');
	}

	 else {
		// if all the fields are filled (not empty)

		//insert data to database
		$result = mysqli_query($mysqli, "INSERT INTO products(name, price, category, brand, stockStatus, status) VALUES('$name','$price','$category', '$brand', '$stockStatus', '1')");

		//display success message
		echo "<script>alert('Data added successfully.')</script>";
		header('Refresh: 2; URL=http://localhost:8080/index.php');
	}
}
?>
</body>
</html>
