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
      <nav class="navbar navbar-expand-lg bg-light mb-3">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">AB</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php"
                  >Home</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#"
                  >Add Item</a
                >
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="container">
        <p class="display-6 text-center mb-5">Add New Product</p>
        <form action="add.php" method="POST" enctype="multipart/form-data">
          <!-- product name and price -->
          <div class="row g-3 mb-3">
            <div class="col">
              <input
                name="name"
                type="text"
                class="form-control"
                placeholder="Product Name"
              />
            </div>
            <div class="col">
              <input
                name="price"
                type="number"
                class="form-control"
                placeholder="Product Price"
              />
            </div>
          </div>
          <!-- product category and brand -->
          <div class="row g-3 mb-3">
            <div class="col">
              <select class="form-select" name="category" id="category">
			          <option value="">Category</option>
				        <?php
				          while($res = mysqli_fetch_array($categoryData)) {
					          echo "<option value=".$res['name'].">".$res['name']."</option>";
				          }
				        ?>

              </select>
            </div>
            <div class="col">
              <select class="form-select" name="brand" id="brand">
                <option value="">Brand</option>
              </select>
            </div>
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
          <div class="input-group mb-3">
            <input
              type="file"
              class="form-control"
              id="inputGroupFile02"
              name="image"
            />
            <label class="input-group-text" for="inputGroupFile02"
              >Product Image</label
            >
          </div>
          <div class="btn_wrapper">
            <input type="submit" class="btn btn-primary" name="submit" />
          </div>
        </form>
      </div>
    </section>
    <script src="bootstrap/bootstrap.bundle.min.js"></script>
    <script src="js/main.js" type="module"></script>
</body>
</html>
