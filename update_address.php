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

    $address = $_POST['building'] .'/ '.$_POST['flat'].', '.$_POST['area'].', '.$_POST['town'] .', '. $_POST['state'] .', '. $_POST['country'] .' , '. $_POST['pin_code'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
 
    $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
    $update_address->execute([$address, $user_id]);
 
    $message[] = 'addres zapisany!';
 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zaktualizuj adres</title>

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

<!-- update address start -->

<section class="form-container">

   <form action="" method="post">
      <h3>twoje dane</h3>
      <input type="text" class="box" placeholder="nr budynku" required maxlength="50" name="building">
      <input type="text" class="box" placeholder="nr mieszkania" required maxlength="50" name="flat">
      <input type="text" class="box" placeholder="nazwa ulicy" required maxlength="50" name="area">
      <input type="text" class="box" placeholder="nazwa miejscowości" required maxlength="50" name="town">
      <input type="text" pattern="^\d{2}-\d{3}$" class="box" placeholder="kod pocztowy"  name="pin_code">
      <input type="text" class="box" placeholder="województwo" required maxlength="50" name="state">
      <input type="text" class="box" placeholder="kraj" required maxlength="50" name="country">
      <input type="submit" value="zmień adres" name="submit" class="btn">
   </form>

</section>

<!-- update address koniec -->

<!-- footer start -->
<?php include 'components/footer.php'; ?>

<!-- footer koniec -->



<!-- custom js file link -->
<script src="js/script.js"></script>
    
</body>
</html>