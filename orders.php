<?php 

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    $message[] = 'zaloguj się!';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zamówienie</title>

    <!-- font awesome cdn link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>


<!-- header start -->
<?php include 'components/user_header.php' ?>
<!-- header koniec -->

<section class="orders">

   <h1 class="title">twoje zamówienia</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">zaloguj się, aby zobaczyć zamówienia</p><a href="login.php" class="btn">zaloguj się</a>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   
   <div class="box">
      <p>numer urzytkownika : <span><?= $fetch_orders['user_id']; ?></span> </p>
      <p>data : <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p>imię : <span><?= $fetch_orders['name']; ?></span></p>
      <p>email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>numer : <span><?= $fetch_orders['number']; ?></span></p>
      <p>adres : <span><?= $fetch_orders['address']; ?></span></p>
      <p>miejsce dostawy : <span><?= $fetch_orders['place_order']; ?></span></p>
      <p>metoda płatności : <span><?= $fetch_orders['method']; ?></span></p>
      <p>zamówione dania : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>razem : <span><?= $fetch_orders['total_price']; ?> PLN</span></p>
      <p> status : <span style="color:<?php if($fetch_orders['payment_status'] == 'przygotowywanie'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">brak zamówień!</p>';
      }
      }
   ?>

   </div>

</section>





<!-- footer start -->
<?php include 'components/footer.php'; ?>

<!-- footer koniec -->


<!-- custom js file link -->
<script src="js/script.js"></script>
    
</body>
</html>