<?php 

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
   $message[] = 'danie usunięte z koszyka!';
}

if(isset($_POST['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   $message[] = 'usunięto wszystko z koszyka!';
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'zaktualizowano liczbę dań';
}

$grand_total = 0;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>koszyk</title>

    <!-- font awesome cdn link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>


<!-- header section starts -->
<?php include 'components/user_header.php' ?>
<!-- header section ends -->


<!-- shopping cart section starts  -->

<section class="products">

   <h1 class="title">koszyk</h1>

   <div class="box-container">

      <?php
         $grand_total = 0;
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
         <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('Usunąć tą potrawę?');"></button>
         <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="btn">zobacz</a><br>
         <div class="name"><?= $fetch_cart['name']; ?></div>
         <div class="flex">
            <div class="price"><?= $fetch_cart['price']; ?><span> PLN</span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
            <button type="submit" class="btn" name="update_qty">zmień</button>
         </div>
         <div class="sub-total"> razem : <span><?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?> PLN</span> </div>
      </form>
      <?php
               $grand_total += $sub_total;
            }
         }else{
            echo '<p class="empty">twój koszyk jest pusty</p>';
         }
      ?>

   </div>

   <div class="more-btn">
   <a href="menu.php" class="btn">kontynuuj zakupy</a>
   </div>

   <div class="cart-total">
      <p>razem : <span><?= $grand_total; ?> PLN</span></p>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">zamów</a>
   </div>

   <div class="more-btn">
      <form action="" method="post">
         <button type="submit" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" name="delete_all" onclick="return confirm('usunąć wszystko z koszyka?');">usuń wszystko</button>
      </form>
      
   </div>

</section>

<!-- shopping cart section ends -->




<!-- footer start -->
<?php include 'components/footer.php'; ?>

<!-- footer end -->


<!-- custom js file link -->
<script src="js/script.js"></script>
    
</body>
</html>