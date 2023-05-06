<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
   $select_admin->execute([$name]);
   
   if($select_admin->rowCount() > 0){
      $message[] = 'użytkownik już istnieje!';
   }else{
      if($pass != $cpass){
         $message[] = 'potwierdź hasło nie pasuje!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admin`(name, password) VALUES(?,?)");
         $insert_admin->execute([$name, $cpass]);
         $message[] = 'nowy administrator zalogowany!';
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
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- register admin start  -->

<section class="form-container">

<h1 class="title">zarejestruj administratora</h1>

   <form action="" method="POST">
      <input type="text" name="name" maxlength="20" required placeholder="podaj nazwę użytkownika" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" maxlength="20" required placeholder="podaj hasło" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" maxlength="20" required placeholder="potwierdź hasło" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="zarejestruj" name="submit" class="btn">
   </form>

</section>

<!-- register admin koiec -->
















<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>