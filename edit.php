<?php
include "config.php";

$id = $_GET['id'];
$product = mysqli_query($conn,"SELECT * FROM products WHERE id=$id");
$row = mysqli_fetch_assoc($product);

$categories = mysqli_query($conn,"SELECT * FROM categories");
$brands = mysqli_query($conn,"SELECT * FROM brands WHERE category_id=".$row['category_id']);
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Product</title>
<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

<div class="container">
<h1>Edit Product</h1>

<form action="update.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<label>Category</label>
<select name="category_id" id="category_id" required>
<option value="">Select Category</option>
<?php while($c=mysqli_fetch_assoc($categories)){ ?>
<option value="<?php echo $c['id']; ?>" <?php if($c['id']==$row['category_id']) echo 'selected'; ?>>
<?php echo $c['category_name']; ?></option>
<?php } ?>
</select>

<label>Brand</label>
<select name="brand_id" id="brand_id" required>
<?php while($b=mysqli_fetch_assoc($brands)){ ?>
<option value="<?php echo $b['id']; ?>" <?php if($b['id']==$row['brand_id']) echo 'selected'; ?>>
<?php echo $b['brand_name']; ?></option>
<?php } ?>
</select>

<label>Product Name</label>
<input type="text" name="product_name" value="<?php echo $row['product_name']; ?>" required>

<label>Description</label>
<textarea name="description"><?php echo $row['description']; ?></textarea>

<label>Current Image</label>
<div>
    <!-- Display current image -->
    <img id="current_img" src="uploads/<?php echo $row['image'] ?: 'no_image.jpg'; ?>" width="150" style="border:1px solid #ccc; border-radius:5px; display:block; margin-bottom:10px;">
    
    <!-- Buttons below the image -->
    <button type="button" id="change_img_btn" class="btn btn-edit" style="margin-bottom:5px;">Change Image</button>
    <button type="button" id="remove_img_btn" class="btn btn-delete">Remove Image</button>
</div>

<!-- Hidden file input for selecting new image -->
<input type="file" name="image" id="image_input" style="display:none;">

<!-- Hidden input to signal removal -->
<input type="hidden" name="remove_image" id="remove_image_input" value="0">

<div class="buttons">
<button type="submit" class="btn btn-add">Update Product</button>
<a href="view.php" class="btn btn-view">Cancel</a>
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

<script>
document.addEventListener('DOMContentLoaded', function(){

    const changeBtn = document.getElementById('change_img_btn');
    const removeBtn = document.getElementById('remove_img_btn');
    const fileInput = document.getElementById('image_input');
    const removeInput = document.getElementById('remove_image_input');
    const currentImg = document.getElementById('current_img');

    // Change Image button
    changeBtn.addEventListener('click', function(){
        fileInput.click();          // open file chooser
        removeInput.value = 0;      // reset remove flag
    });

    // Preview selected image
    fileInput.addEventListener('change', function(){
        if(this.files && this.files[0]){
            const reader = new FileReader();
            reader.onload = function(e){
                currentImg.src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Remove Image button
    removeBtn.addEventListener('click', function(){
        currentImg.src = 'uploads/no_image.jpg'; // set to default
        fileInput.value = '';                     // clear any selected file
        removeInput.value = 1;                    // set remove flag
    });

});
</script>

</body>
</html>