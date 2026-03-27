<?php
include "config.php";

$category_id = $_POST['category_id'];
$brand_id = $_POST['brand_id'];
$product_name = $_POST['product_name'];
$description = $_POST['description'];

$image = $_FILES['image']['name'];
$temp = $_FILES['image']['tmp_name'];

if($image != ""){
    move_uploaded_file($temp,"uploads/".$image);
} else {
    $image = "no_image.jpg"; // default image if none uploaded
}

$query = "INSERT INTO products (category_id,brand_id,product_name,description,image)
VALUES ('$category_id','$brand_id','$product_name','$description','$image')";

mysqli_query($conn,$query);

echo "<script>
alert('Product Added Successfully');
window.location='view.php';
</script>";
?>