<?php
include "config.php";

$id = $_POST['id'];
$category_id = $_POST['category_id'];
$brand_id = $_POST['brand_id'];
$product_name = $_POST['product_name'];
$description = $_POST['description'];

$image = $_FILES['image']['name'];
$temp = $_FILES['image']['tmp_name'];
$remove_image = isset($_POST['remove_image']) && $_POST['remove_image'] == 1;

if($image != ""){
    // Upload new image
    move_uploaded_file($temp,"uploads/".$image);
    $query = "UPDATE products
              SET category_id='$category_id',
                  brand_id='$brand_id',
                  product_name='$product_name',
                  description='$description',
                  image='$image'
              WHERE id=$id";
} elseif($remove_image) {
    // Remove image
    $query = "UPDATE products
              SET category_id='$category_id',
                  brand_id='$brand_id',
                  product_name='$product_name',
                  description='$description',
                  image='no_image.jpg'
              WHERE id=$id";
} else {
    // Keep current image
    $query = "UPDATE products
              SET category_id='$category_id',
                  brand_id='$brand_id',
                  product_name='$product_name',
                  description='$description'
              WHERE id=$id";
}

mysqli_query($conn, $query);

echo "<script>
alert('Product Updated Successfully');
window.location='view.php';
</script>";
?>