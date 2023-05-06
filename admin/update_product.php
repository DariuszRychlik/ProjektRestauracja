<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $ingredients = $_POST['ingredients'];
   $ingredients = filter_var($ingredients, FILTER_SANITIZE_STRING);

   $update_product = $conn->prepare("UPDATE `products` SET name = ?, category = ?, price = ?, ingredients = ? WHERE id = ?");
   $update_product->execute([$name, $category, $price, $ingredients, $pid]);

   $message[] = 'produkt zaktualizowany!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   if(!empty($image)){
      if($image_size > 10000000){
         $message[] = 'rozmiar obrazu jest za duży!';
      }else{
         $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $pid]);
         move_uploaded_file($image_tmp_name, $image_folder);
         //unlink('../uploaded_img/'.$old_image);
         $message[] = 'obraz zaktualizowany!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>zaktualizuj produkt</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- update product section starts  -->

<h1 class="title">zaktualizuj produkt</h1>

<section class="form-container">

   <?php
      $update_id = $_GET['update'];
      $show_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $show_products->execute([$update_id]);
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
      <input type="hidden" name="ingredients" value="<?= $fetch_products['ingredients']; ?>">

      <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <span>zaktualizuj nazwę</span>
      <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box" value="<?= $fetch_products['name']; ?>">
      <span>zaktualizuj składniki</span>
      <textarea name="ingredients" class="box" required placeholder="składniki" maxlength="500" cols="30" rows="10"><?= $fetch_products['ingredients']; ?></textarea>
      <span>zaktualizuj cenę</span>
      <input type="number"  min="0.00" max="9999999999.00"  step="0.01" maxlength="12" required placeholder="podaj cenę produktu" name="price" onkeypress="if(this.value.length == 10) return false;" class="box"/>
      <span>zaktualizuj kategorię</span>
      <select name="category" class="box" required>
         <option selected value="<?= $fetch_products['category']; ?>"><?= $fetch_products['category']; ?></option>
         <option value="main dish">main dish</option>
         <option value="fast food">fast food</option>
         <option value="drinks">drinks</option>
         <option value="desserts">desserts</option>
      </select>
      <span>zaktualizuj obraz</span>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <div class="flex-btn">
         <input type="submit" value="update" class="btn" name="update">
         <a href="products.php" class="btn">wstecz</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">brak dodanych produktów!</p>';
      }
   ?>

</section>

<!-- update product section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>