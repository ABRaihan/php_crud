<?php
//including the database connection file
include("config.php");

//getting id of the data from url
$id = $_GET['id'];

$result = mysqli_query($mysqli, "UPDATE products SET status='0' WHERE id=$id");

//redirecting to the display page (index.php in our case)
header("Location:index.php");
?>

