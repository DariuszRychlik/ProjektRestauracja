<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
   $delete_admin->execute([$delete_id]);
   header('location:admin_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>administratorzy</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admins accounts start  -->

<section class="accounts">

<h1 class="title">administratorzy</h1>

   <div class="box-container">

   <div class="box">
      <p>zarejestruj nowego admina</p>
      <a href="register_admin.php" class="btn">zarejestruj</a>
   </div>

   <?php
      $select_account = $conn->prepare("SELECT * FROM `admin`");
      $select_account->execute();
      if($select_account->rowCount() > 0){
         while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <p> numer admina : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> nazwa admina : <span><?= $fetch_accounts['name']; ?></span> </p>
      <div class="flex-btn">
         <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('usunąć to konto?');">usuń</a>
         <?php
            if($fetch_accounts['id'] == $admin_id){
               echo '<a href="update_profile.php" class="btn">zaktualizuj</a>';
            }
         ?>
      </div>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">brak administratorów</p>';
   }
   ?>

   </div>

</section>

<!-- admins accounts koniec -->




















<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>