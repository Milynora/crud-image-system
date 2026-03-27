<?php
include "config.php";
$categories = mysqli_query($conn,"SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>
<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

<div class="container">
<h1>Add Product</h1>

<form action="add.php" method="POST" enctype="multipart/form-data">

<label>Category</label>
<select name="category_id" id="category_id" required>
<option value="">Select Category</option>
<?php while($c=mysqli_fetch_assoc($categories)){ ?>
<option value="<?php echo $c['id']; ?>"><?php echo $c['category_name']; ?></option>
<?php } ?>
</select>

<label>Brand</label>
<select name="brand_id" id="brand_id" required>
<option value="">Select Brand</option>
</select>

<label>Product Name</label>
<input type="text" name="product_name" required>

<label>Description</label>
<textarea name="description"></textarea>

<label>Upload Image</label>
<input type="file" name="image">

<div class="buttons">
<button type="submit" class="btn btn-add">Add Product</button>
<a href="view.php" class="btn btn-view">View Products</a>
</div>

</form>
</div>

<script>
$(document).ready(function(){
    $('#category_id').change(function(){
        var category_id = $(this).val();
        if(category_id != ''){
            $.ajax({
                url:"get_brands.php",
                method:"GET",
                data:{category_id:category_id},
                success:function(data){
                    $('#brand_id').html(data);
                }
            });
        } else {
            $('#brand_id').html('<option value="">Select Brand</option>');
        }
    });
});
</script>

</body>
</html>