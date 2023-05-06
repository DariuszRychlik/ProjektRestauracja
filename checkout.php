<?php 

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:home.php');
};


if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $place_order = $_POST['place_order'];
    $place_order = filter_var($place_order, FILTER_SANITIZE_STRING);
    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];
 
    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);
 
    if($check_cart->rowCount() > 0){
 
       if($address == ''){
          $message[] = 'proszę podaj swój adres!';
       }else{
          
          $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, place_order, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?,?)");
          $insert_order->execute([$user_id, $name, $number, $email, $place_order, $method, $address, $total_products, $total_price]);
 
          $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
          $delete_cart->execute([$user_id]);
 
          $message[] = 'Zamówienie przyjęte do realizacji!';
       }
       
    }else{
       $message[] = 'twój koszyk jest pusty';
    }
 
 }
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>podsumowanie</title>

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
<!-- header skoniec -->

<section class="checkout">

   <h1 class="title">podsumowanie</h1>

<form action="" method="post">

   <div class="cart-items">
      <h3>Koszyk :</h3>
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' PLN x '. $fetch_cart['quantity'].' szt. ) - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
      ?>
      <p><span class="name"><?= $fetch_cart['name']; ?></span><span class="price"><?= $fetch_cart['quantity']; ?> szt. x <?= $fetch_cart['price']; ?> PLN</span></p>
      <?php
            }
         }else{
            echo '<p class="empty">Twój koszyk jest pusty!</p>';
         }
      ?>
      <p class="grand-total"><span class="name">Razem :</span><span class="price"><?= $grand_total; ?> PLN</span></p>
      <a href="cart.php" class="btn">koszyk</a>
   </div>

   <input type="hidden" name="total_products" value="<?= $total_products; ?>">
   <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
   <input type="hidden" name="name" value="<?= $fetch_profile['name'] ?>">
   <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
   <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
   <input type="hidden" name="address" value="<?= $fetch_profile['address'] ?>">

   <div class="user-info">
      <h3>twoje dane</h3>
      <p><i class="fas fa-user"></i><span><?= $fetch_profile['name'] ?></span></p>
      <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number'] ?></span></p>
      <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email'] ?></span></p>
      <a href="update_profile.php" class="btn">zmień informacje</a>
      <h3>adres dostawy</h3>
      <p><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'proszę podaj swój adres';}else{echo $fetch_profile['address'];} ?></span></p>
      <a href="update_address.php" class="btn">zmień adres</a>
      <select name="place_order" class="box" required>
         <option value="" disabled selected>Wybierz miejsce --</option>
         <option value="na_miejscu">na miejscu</option>
         <option value="na_wynos">na wynos</option>
         <option value="delivery">dostawa pod adres</option>
      </select>
      <select name="method" class="box" required>
         <option value="" disabled selected>wybierz metodę płatności --</option>
         <option value="gotówka">gotówka</option>
         <option value="karta kredytowa">karta kredytowa</option>
      </select>
      <input type="submit" value="złóż zamówienie" class="btn <?php if($fetch_profile['address'] == ''){echo 'disabled';} ?>" style="width:100%; background:var(--red); color:var(--white);" name="submit">
   </div>

</form>
   
</section>




<!-- footer start -->
<?php include 'components/footer.php'; ?>

<!-- footer koniec -->



<!-- custom js file link -->
<script src="js/script.js"></script>
    
</body>
</html>