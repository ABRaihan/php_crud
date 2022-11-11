<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Product</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

<?php
//including the database connection file
include_once("config.php");
if(isset($_POST['submit'])) {
	$name = $_POST['name'];
	$price = $_POST['price'];
	$category = $_POST['category'];
	$brand = $_POST['brand'];
	$stockStatus = $_POST['stockStatus'];
	$file_name = $_FILES["image"]["name"];
	$file_temp = $_FILES["image"]["tmp_name"];

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
		header('Refresh: 2; URL=add.php');
	}

	 else {
    if(move_uploaded_file($file_temp, "images/".$file_name)){
      $result = mysqli_query($dbCon, "INSERT INTO products(name, price, category, brand, stockStatus, status, img_src) VALUES('$name','$price','$category', '$brand', '$stockStatus', '1', '$file_name')");
		  echo "<script>alert('Data added successfully.')</script>";
		  header('Refresh: 1; URL=http://localhost:8080/index.php');
    }else{
      echo "Upload Image Occur";
      header('Refresh: 1; URL=add.php');
    }

	}
}
?>
<!-- data fetch from database -->

<section>
	<?php
		$categoryData = mysqli_query($dbCon, "SELECT * FROM category");
	?>
      <div class="container">
        <h2 class="text-center mb-5 mt-4">Insert New Item</h2>
        <form action="add.php" method="POST" enctype="multipart/form-data">
          <!-- product name and price -->
          <div class="row g-3 mb-3">
            <div class="col">
              <label for="name" class="form-label">Product Name</label>
              <input
                name="name"
                type="text"
                class="form-control mb-3"
                id="name"
              />
              <label for="price" class="form-label">Product Price</label>
              <input
                name="price"
                type="number"
                class="form-control"
                id="price"
              />
            </div>
            <div class="col"></div>
          </div>
          <!-- product category and brand -->
          <div class="row g-3 mb-3">
            <div class="col">
              <label for="category" class="form-label">Select Category</label>
              <select class="form-select mb-3" name="category" id="category">
			          <option value="">Category</option>
				        <?php
				          while($res = mysqli_fetch_array($categoryData)) {
					          echo "<option value=".$res['name'].">".$res['name']."</option>";
				          }
				        ?>
              </select>
              <label for="brand" class="form-label">Select Brand</label>
              <select class="form-select" name="brand" id="brand">
                <option value="">Brand</option>
              </select>
            </div>
            <div class="col"></div>
          </div>
          <!-- product stock details -->
          <div class="input-group mb-3">
            <div class="form-check me-3">
              <input
                class="form-check-input"
                type="radio"
                name="stockStatus"
                id="flexRadioDefault1"
                value="1"
                checked
              />
              <label class="form-check-label" for="flexRadioDefault1">
                Stock In
              </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="stockStatus"
                id="flexRadioDefault2"
                value="0"
              />
              <label class="form-check-label" for="flexRadioDefault2">
                Stock Out
              </label>
            </div>
          </div>
          <!-- product image -->
          <div class="row mb-3">
            <div class="col">
                <input
                  type="file"
                  class="form-control"
                  id="inputGroupFile02"
                  name="image"
                />
            </div>
            <div class="col"></div>
          </div>
          <div class="btn_wrapper">
              <a href="index.php" class="me-4">Go To Home</a>
            <input type="submit" name="submit" />
          </div>
        </form>
      </div>
    </section>
    <script src="bootstrap/bootstrap.bundle.min.js"></script>
    <script src="js/main.js" type="module"></script>
</body>
</html>
