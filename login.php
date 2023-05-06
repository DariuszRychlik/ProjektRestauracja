<?php 

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
 
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
 
    if($select_user->rowCount() > 0){
       $_SESSION['user_id'] = $row['id'];
       header('location:home.php');
    }else{
       $message[] = 'nieprawidłowe hasło!';
    }
 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zaloguj się</title>

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

<!-- login section starts -->

<section class="form-container">

   <form action="" method="post">
      <h3>zaloguj się</h3>
      <input type="email" name="email" required placeholder="podaj swój email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="podaj swoje hasło" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="zaloguj się" name="submit" class="btn">
      <p>nie masz konta? <a href="register.php" class="btn">zarejestruj się</a></p>
   </form>

</section>


<!-- login section ends -->

<!-- footer section starts -->
<?php include 'components/footer.php'; ?>

<!-- footer section ends -->


<!-- custom js file link -->
<script src="js/script.js"></script>
    
</body>
</html>