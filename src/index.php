<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated

$result = mysqli_query($mysqli, "SELECT * FROM products ORDER BY id DESC"); // using mysqli_query instead
?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Homepage</title>
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<section>
		<div class="container">
			<p class="display-6 text-center mt-4">Product List</p>
			<table class="table table-striped table-hover mt-5">
				<tr>
					<th>Name</th>
					<th>Price</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Stock</th>
					<th>Actions</th>
				</tr>
				<?php
				$stockText = "";
					while($res = mysqli_fetch_array($result)) {
						if($res['stockStatus'] == 1) {
							$stockText = "In Stock";
						} else {
							$stockText = "Out of Stock";
						}
						if($res['status'] == 1){
							echo "<tr>";
							echo "<td>".$res['name']."</td>";
							echo "<td>".$res['price']."</td>";
							echo "<td>".$res['category']."</td>";
							echo "<td>".$res['brand']."</td>";
							echo "<td>".$stockText."</td>";
							echo "<td><a href=\"edit.php?id=$res[id]\">
							<button type=\"button\" class=\"btn btn-success\">Edit</button></a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm(\'Are you sure you want to delete?\')\">
							<button type=\"button\" class=\"btn btn-danger\">Delete</button></a></td>";
						}
					}

				?>
			</table>
			<div class="btn_wrapper">
				<a href="add.html">
					<button type="button" class="btn btn-primary">Add New Product</button>
				</a>
			</div>
		</div>
	</section>

</body>
</html>
