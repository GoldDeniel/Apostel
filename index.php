<!DOCTYPE html>
<html lang="hun">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="assets/images/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
    rel="stylesheet">

    <title>ApostHell | Kezdőlap</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/owl.css">

</head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="preloader">
    <div class="jumper">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- Header -->

  <?php
  include 'elements/header.php';
  ?>

  <!-- Page Content -->
  <!-- Banner Starts Here -->
  <div class="banner header-text">
    <div class="owl-banner owl-carousel">
      <div class="banner-item-01">
        <div class="text-content">
          <h4>A kedvenc söröd itt megtalálod!</h4>
          <h2>ApostHell</h2>
        </div>
      </div>
      <div class="banner-item-02">
        <div class="text-content">
          <!-- Itt a lentihez kepest szinten, please -->
          <h4>Nem volt pénzünk igazi modellekre</h4>
          <h2>Szép lányok</h2>
        </div>
      </div>
      <div class="banner-item-03">
        <div class="text-content">
          <!-- TODO: Ezeket kerlek majd a stilus alapjan lodd be, a problema, hogy nem latszik a text -->
          <h4 style="color: black; text-shadow: 2px 2px 4px #ffffff;">Óriási kínálat várja azokat, akik szomjasak</h4>
          <h2 style="text-shadow: 2px 2px 4px #000000;">Változatosság</h2>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner Ends Here -->

  <div class="latest-products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Kiemelt sörkínálatunk</h2>
            <a href="products.php">továbbiak<i class="fa fa-angle-right"></i></a>
          </div>
        </div>
        <?php

        require_once 'credentials.php';
        $conn = get_connection();
        $sql = "SELECT * FROM Beers ORDER BY id LIMIT 6";

        $res = $conn->query($sql);
        $records = $res->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($records);
        
        foreach ($records as $record_beer) {

          $prize = $record['price'] == 0 ? "<span style=\"color: red\">Jelenleg nincs raktáron</span>" : "$".$record['price'];

          echo
            "
            <div class=\"col-md-4\">
              <div class=\"product-item\">
                <a href=\"product-details.php\"><img src=\"assets/images/" . $record_beer['img_url'] . "\"></a>
                <div class=\"down-content\">
                  <a href=\"product-details.php\"><h4>" . $record_beer['label'] . "</h4></a>
                  <h6>" . $prize . "</h6>
                  <p>" . $record_beer['description'] . "</p>
                </div>
              </div>
            </div>
          ";
        }
        // $conn -> close();
        
        $conn = null;
        ?>

    <div class="best-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Rólunk</h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <p class="secondary-color">Ismerd meg az ApostHell söröket - a minőség és szenvedély tökéletes összhangját! Kézműves szakértelemmel készítettünk kiváló minőségű söröket, hogy minden korty egy különleges utazás legyen az igazi ízek birodalmába. Fedezd fel a sörkultúra új csúcsait velünk!</p>
              <a href="about-us.php" class="filled-button">Tudj meg többet</a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="assets/images/unnamed_stock_photo3.jpeg" class="round-top" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="services" >
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Legfrissebb posztjaink</h2>

              <a href="blog.php">továbbiak<i class="fa fa-angle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="service-item">
              <a href="#" class="services-item-image"><img src="assets/images/product-2.jpeg" class="img-fluid" alt=""></a>

              <div class="down-content">
                <h4><a href="#">Elkészítettük a kéréseitek alapján várva-várt legújabb sörünket, a HolyHell-t</a></h4>

                <p style="margin: 0;"> Dániel Arany &nbsp;&nbsp;|&nbsp;&nbsp; 10/05/2024 08:11 </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="service-item">
              <a href="#" class="services-item-image"><img src="assets/images/beer-2.jpg" class="img-fluid" alt=""></a>

              <div class="down-content">
                <h4><a href="#">Kikértük a véleményeteket: ezeket a dolgokat kértétek, hogy jellemezzék a legújabb sörünket</a></h4>

                <p style="margin: 0;"> János Orsós &nbsp;&nbsp;|&nbsp;&nbsp; 20/04/2024 11:25 </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="service-item">
              <a href="#" class="services-item-image"><img src="assets/images/beer-delivery-logo.jpg" class="img-fluid" alt=""></a>

              <div class="down-content">
                <h4><a href="#">Bővültek szállítási lehetőségeink, most már két újabb országban is élvezhetik söreinket</a></h4>

                <p style="margin: 0;"> János Orsós &nbsp;&nbsp;|&nbsp;&nbsp; 12/04/2024 16:46</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

        <!-- Elon musk es tarsai -->

    <div class="happy-clients">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Elégedett ügyfeleink</h2>

              <a href="testimonials.php">továbbiak <i class="fa fa-angle-right"></i></a>
            </div>
          </div>
          <div class="col-md-12">
            <div class="owl-clients owl-carousel text-center">
              <div class="service-item">
                <div class="services-item-image">
                  <img src="assets/images/elon_musk_beer.jpg" class="round-top" alt=""></i>
                </div>
                <div class="down-content">
                  <h4>Elon Musk</h4>
                  <p class="n-m"><em>"Amint megízleltem, a kedvenc sörömmé vált az ApostHell. Fiammal, X Æ A-12-al délutánonként csak ezt isszuk!"</em></p>
                </div>
              </div>
              
              <div class="service-item">
                <div class="services-item-image">
                  <img src="assets/images/mark_zuck_beer.jpg" class="round-top" alt=""></i>
                </div>
                <div class="down-content">
                  <h4>Mark Zuckerberg</h4>
                  <p class="n-m"><em>"Már a Harvardos óta ezt a sört iszom, sokat segített a Facebook kitalálásához."</em></p>
                </div>
              </div>
              
              <div class="service-item">
                <div class="services-item-image">
                  <img src="assets/images/damu_roland_beer.png" class="round-top" alt=""></i>
                </div>
                <div class="down-content">
                  <h4>Damu Roland</h4>
                  <p class="n-m"><em>"Általában amikor már reggel felkelek, hogy pucoljam a marhát, amikor nehogy már olyan nyerjen, aki nem tud főzni, aközben mindig az ApostHellt választom!"</em></p>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="call-to-action">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <div class="row">
                <div class="col-md-8">
                  <h4>Jogi nyilatkozat</h4>
                  <p>Ez az oldal nem létezik, és a sörünknek semmi köze az igazi Apostel sörhöz.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-right">
                  <a href="contact.php" class="filled-button" onclick="alert('I said don\'t!')">Ne lépj velünk kapcsolatba</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


        <?php
        include 'elements/footer.php';
        ?>


        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


        <!-- Additional Scripts -->
        <script src="assets/js/custom.js"></script>
        <script src="assets/js/owl.js"></script>
</body>

</html>