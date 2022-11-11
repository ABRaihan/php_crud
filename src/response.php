<?php
include_once("config.php");
if (!empty($_POST["id"])) {
    $id = $_POST['id'];
    $query = "select * from brands where id=$id";
    $result = mysqli_query($dbCon, $query);
    if ($result->num_rows > 0) {
        echo '<option value="">Brand</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
        }
    }
}
?>