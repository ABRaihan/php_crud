<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$price = $_POST['price'];
	$category = $_POST['category'];
	$brand = $_POST['brand'];
	$stockStatus = $_POST['stockStatus'];

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
		header("Refresh: 2; URL=http://localhost:8080/edit.php?id=$id");
	} else {
		//updating the table
		$result = mysqli_query($dbCon, "UPDATE products SET name='$name',price='$price', category='$category', brand='$brand', stockStatus='$stockStatus' WHERE id=$id");
		// echo "<script>alert('Data Update successfully.')</script>";
		//redirecting to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];
$categoryData = mysqli_query($dbCon, "SELECT * FROM category");
$result = mysqli_query($dbCon, "SELECT * FROM products WHERE id=$id");

while($res = mysqli_fetch_array($result)){
	$name = $res['name'];
	$price = $res['price'];
	$category = $res['category'];
	$brand = $res['brand'];
	$stockStatus = $res['stockStatus'];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Product</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <section>
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
                  >Edit</a
                >
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="container">
        <p class="display-6 text-center mb-5">Update Product</p>
        <form action="edit.php" method="POST">
          <!-- product name and price -->
          <div class="row g-3 mb-3">
            <div class="col">
              <input
			  	      value="<?php echo $name;?>"
                name="name"
                type="text"
                class="form-control"
                placeholder="Product Name"
              />
            </div>
            <div class="col">
              <input
			  	      value="<?php echo $price;?>"
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
              while($res = mysqli_fetch_array($categoryData)){
                $value = $res["name"];
                $selected = "";
                global $categoryID;
                if($category == $value){
                  $selected = "selected";
                  $categoryID = $res["id"];
                }
                echo "<option value=\"$value\" $selected>$value</option>";
              }
               ?>
              </select>
            </div>
            <div class="col">
              <select class="form-select" name="brand" id="brand">
                <option value="">Brand</option>
                <?php
                $brandData = mysqli_query($dbCon, "SELECT * FROM brands WHERE id=$categoryID");
                // $brands = $brandValue->$selectedValue;
                while($res = mysqli_fetch_array($brandData)){
                    $value = $res["name"];
                    $selected = "";
                    if($brand == $value){
                      $selected = "selected";
                    }
                    echo "<option value=\"$value\" $selected>$value</option>";
                  }
                ?>
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
				        <?=$stockStatus == '1' ? 'checked' : '';?>
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
				        <?=$stockStatus !== '1' ? 'checked' : '';?>
              />
              <label class="form-check-label" for="flexRadioDefault2">
                Stock Out
              </label>
            </div>
          </div>
          <!-- product image -->
          <div class="btn_wrapper">
		  	    <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
            <input type="submit" class="btn btn-primary" name="update" value="Update" />
          </div>
        </form>
      </div>
    </section>
    <script src="bootstrap/bootstrap.bundle.min.js"></script>
    <script src="js/main.js" type="module"></script>
  </body>
</html>
