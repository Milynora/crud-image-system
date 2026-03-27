<?php 
include "config.php";

$query = "SELECT products.*, categories.category_name, brands.brand_name
FROM products
JOIN categories ON products.category_id = categories.id
JOIN brands ON products.brand_id = brands.id";

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Product List</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h1>Product List</h1>

<div class="top-bar">
<a href="index.php" class="btn btn-add">Add Product</a>
</div>

<table>

<tr>
<th>ID</th>
<th>Category</th>
<th>Brand</th>
<th>Name</th>
<th>Description</th>
<th>Image</th>
<th>Actions</th>
</tr>

<?php 
if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)){
?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['category_name']; ?></td>
<td><?php echo $row['brand_name']; ?></td>
<td><?php echo $row['product_name']; ?></td>
<td class="desc"><?php echo $row['description']; ?></td>

<td>
<?php
$image = $row['image'];
$path = "uploads/" . $image;

if($image == "" || !file_exists($path)){
    echo "<img src='uploads/no_image.jpg' width='70'>";
} else {
    echo "<img src='$path' width='70'>";
}
?>
</td>

<td class="actions">

<a class="btn btn-edit" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>

<a class="btn btn-delete"
href="delete.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this product?')">
Delete
</a>

</td>

</tr>

<?php
}

}else{
?>

<tr>
<td colspan="7">No products in the list</td>
</tr>

<?php
}
?>

</table>

</div>

</body>
</html>