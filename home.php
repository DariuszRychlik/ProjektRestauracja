<?php 

//połączenie z bazą danych
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

include 'components/add_cart.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <!-- font awesome cdn link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />


    <!-- link swiper -->

    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>



<!-- header start -->
<?php include 'components/user_header.php' ?>
<!-- header koniec -->

<!-- home  start -->

<section class="home">

<h1 class="title">Strona główna</h1>

    <div class="swiper home-slider">
        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <div class="content">
                    <span>zamów na miejscu</span>
                    <h3>Pizza z dodatkami</h3>
                    <a href="menu.php" class="btn">zobacz menu</a>
                </div>
                <div class="image">
                    <img src="images/pizza.png" alt="" />
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>zamów na wynos</span>
                    <h3>udko z kurczaka</h3>
                    <a href="menu.php" class="btn">zobacz menu</a>
                </div>
                <div class="image">
                    <img src="images/chicken.png" alt="" />
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>zamów z dowozem</span>
                    <h3>chrupiące frytki</h3>
                    <a href="menu.php" class="btn">zobacz menu</a>
                </div>
                <div class="image">
                    <img src="images/chips.png" alt="" />
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>wybierz dodatki</span>
                    <h3>ciasto kremowe</h3>
                    <a href="menu.php" class="btn">zobacz menu</a>
                </div>
                <div class="image">
                    <img src="images/cake.png" alt="" />
                </div>
          </div>
        </div>

        <div class="swiper-pagination"></div>

    </div>
</section>

<!-- home koniec -->

<!-- home category start -->

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

<!-- home category koniec -->

<!-- footer start -->
<?php include 'components/footer.php'; ?>

<!-- footer koniec -->

<!--  link swiper  -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link -->
<script src="js/script.js"></script>

<script>
    var swiper = new Swiper(".home-slider", {
        effect: "cube",
        grabCursor: true,
        loop:true,
        
        
        cubeEffect: {
          shadow: true,
          slideShadows: true,
          shadowOffset: 20,
          shadowScale: 0.94,
        },
        pagination: {
            clickable:true,
          el: ".swiper-pagination",
          
        },
      });
</script>
    
</body>
</html>