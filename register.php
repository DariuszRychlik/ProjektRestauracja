<?php 

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
 
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
    $select_user->execute([$email, $number]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
 
    if($select_user->rowCount() > 0){
       $message[] = 'email lub numer już istnieje!';
    }else{
       if($pass != $cpass){
          $message[] = 'Hasła nie pasują!';
       }else{
          $insert_user = $conn->prepare("INSERT INTO `users`(name, email, number, password) VALUES(?,?,?,?)");
          $insert_user->execute([$name, $email, $number, $cpass]);
          $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
          $select_user->execute([$email, $pass]);
          $row = $select_user->fetch(PDO::FETCH_ASSOC);
          if($select_user->rowCount() > 0){
             $_SESSION['user_id'] = $row['id'];
             header('location:home.php');
          }
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
    <title>rejestracja</title>

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

<!-- rejestracja start -->

<section class="form-container">

   <form action="" method="post">
      <h3>zarejestruj się</h3>
      <input type="text" name="name" required placeholder="podaj swoje imię" class="box" maxlength="50">
      <input type="email" name="email" required placeholder="podaj swój email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="tel" name="number" required placeholder="podaj swój nr telefonu" class="box" min="0" max="9999999999" maxlength="12">
      <input type="password" name="pass" required placeholder="podaj hasło" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="potwierdź hasło" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="wyślij formularz" name="submit" class="btn">
      <p>masz już konto ? <a href="login.php" class="btn">zaloguj się</a></p>
   </form>

</section>

<!-- rejestracja koniec -->


<!-- footer start -->
<?php include 'components/footer.php'; ?>

<!-- footer koniec -->


<!-- custom js file link -->
<script src="js/script.js"></script>
    
</body>
</html>