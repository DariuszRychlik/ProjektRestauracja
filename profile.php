<?php 

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:home.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
    $delete_users->execute([$delete_id]);
    $delete_order = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
    $delete_order->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart->execute([$delete_id]);
    header('location:profile.php');
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil</title>

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

<!-- profil start -->
<section class="user-profile">

<?php
      $select_account = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
      $select_account->execute([$user_id]);
      if($select_account->rowCount() > 0){
         while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
?>

   <div class="box">
      <p><i class="fas fa-user"></i><span><?= $fetch_profile['name']; ?></span></p>
      <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number']; ?></span></p>
      <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email']; ?></span></p>
      <a href="update_profile.php" class="btn">zmień informacje</a>
      <p class="address"><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'Podaj adress';}else{echo $fetch_profile['address'];} ?></span></p>
      <a href="update_address.php" class="btn">zmień adres</a>
      <a href="profile.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('usunąć konto?');">usuń konto</a>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">konto usunięte</p>';
      session_start();
      session_unset();
      session_destroy();
   }
   ?>

</section>
<!-- profile koniec -->

<!-- footer start -->
<?php include 'components/footer.php'; ?>

<!-- footer koniec -->


<!-- custom js file link -->
<script src="js/script.js"></script>
    
</body>
</html>