<?php
include "config.php";

$category_id = $_GET['category_id'];

$brands = mysqli_query($conn, "SELECT * FROM brands WHERE category_id = $category_id");

$options = "<option value=''>Select Brand</option>";

while($b = mysqli_fetch_assoc($brands)){
    $options .= "<option value='".$b['id']."'>".$b['brand_name']."</option>";
}

echo $options;
?>