<?php 

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>menu</title>

    <!-- font awesome cdn link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>


<!-- header  start -->
<?php include 'components/user_header.php' ?>
<!-- header koniec -->


<!-- menu  start  -->

<section class="home-category">
    <h1 class="title">Kategorie</h1>

    <div class="box-container">
        <a href="category.php?category=zupa" class="box">
            
            <h3>zupy</h3>
        </a>

        <a href="category.php?category=drugie dania" class="box">
            
            <h3>dania</h3>
        </a>

        <a href="category.php?category=napoje" class="box">
            
            <h3>napoje</h3>
        </a>

        <a href="category.php?category=desery" class="box">
            
            <h3>desery</h3>
        </a>

    </div>

</section>


<section class="products">

   <h1 class="title">Nasze potrawy</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="btn">zobacz</a><br>
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price"><?= $fetch_products['price']; ?><span> PLN</span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2"">
         </div>
         
         <button type="submit" class="btn" name="add_to_cart">do koszyka</button>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">brak produktów!</p>';
         }
      ?>

   </div>

   

</section>




<!-- menu koniec -->


<!-- footer  start -->
<?php include 'components/footer.php'; ?>

<!-- footer koniec -->


<!-- custom js file link -->
<script src="js/script.js"></script>
    
</body>
</html>