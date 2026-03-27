<?php
include "config.php";

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM products WHERE id=$id");

echo "<script>
alert('Product Deleted Successfully');
window.location='view.php';
</script>";