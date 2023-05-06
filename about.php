<?php 

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>

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


<!-- Placówki start  -->

<section class="facility">

   <h1 class="title">nasze placówki</h1>

   <div class="swiper facility-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2577.5566700170857!2d18.623884115706407!3d49.75678487938576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471403fdefccb5b7%3A0x1a7a93661fe99d29!2sAkademia%20WSB%20Wydzia%C5%82%20Zamiejscowy%20w%20Cieszynie!5e0!3m2!1spl!2spl!4v1669306383375!5m2!1spl!2spl" width="250" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <p><a href="https://g.page/akademiawsbcieszyn?share8">Cieszyn, ul. Frysztacka 44</a></p>
            <p></p>
            <h3>Cieszyn</h3>
         </div>

         <div class="swiper-slide slide">
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2547.149020009023!2d19.189581315726915!3d50.32647097945846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4716da24d876753f%3A0xd89ffbcd92cc2eb!2sAkademia%20WSB%20D%C4%85browa%20G%C3%B3rnicza!5e0!3m2!1spl!2spl!4v1669307109176!5m2!1spl!2spl" width="250" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <p><a href="https://goo.gl/maps/5Q2gDfPA2puBShbLA">Zygmunta Cieplaka 1c, 41-300 Dąbrowa Górnicza</a></p>
            <p></p>
            <h3>Dąbrowa Górnicza</h3>
         </div>

         <div class="swiper-slide slide">
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2560.632611062838!2d19.985314015717815!3d50.07444167942522!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47165ad149c93ac5%3A0x44103970c67d884c!2sAkademia%20WSB%20Wydzia%C5%82%20Zamiejscowy%20w%20Krakowie!5e0!3m2!1spl!2spl!4v1669307323627!5m2!1spl!2spl" width="250" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <p><a href="https://goo.gl/maps/XGyKGJwqpqzzFAEV9">Ułanów 3, 31-450 Kraków</a></p>
            <p></p>
            <h3>Kraków</h3>
         </div>

         <div class="swiper-slide slide">
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2549.7799502564867!2d19.576306515629007!3d50.27736720770248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4716e37b2c1b1ebd%3A0x63bde35feb6962c3!2sAkademia%20WSB%20Wydzia%C5%82%20Zamiejscowy%20w%20Olkuszu!5e0!3m2!1spl!2spl!4v1669307500633!5m2!1spl!2spl" width="250" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <p><a href="https://goo.gl/maps/6Zaeq3aqXxYSWod57">Polna 8, 32-300 Olkusz</a></p>
            <p></p>
            <h3>Olkusz</h3>
         </div>

         <div class="swiper-slide slide">
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2581.339668084347!2d19.209264815609764!3d49.685576050060604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47142883a59426eb%3A0xd80c2cdc4d12bb69!2sAkademia%20WSB%20Wydzia%C5%82%20Zamiejscowy%20w%20%C5%BBywcu!5e0!3m2!1spl!2spl!4v1669307626747!5m2!1spl!2spl" width="250" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <p><a href="https://g.page/AkademiaWSBzywiec?share">Komisji Edukacji Narodowej 3, 34-300 Żywiec</a></p>
            <p></p>
            <h3>Żywiec</h3>
         </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<!-- Placówki koniec -->

<!-- footer start -->
<?php include 'components/footer.php'; ?>

<!-- footer koniec -->

<!--  link swiper  -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>


<!-- custom js file link -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".facility-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});
</script>
    
</body>
</html>