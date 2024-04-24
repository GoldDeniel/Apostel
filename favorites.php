<!DOCTYPE html>
<html lang="hu">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Kedvencek</title>

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
    <div class="page-heading about-heading header-text" style="background-image: url(assets/images/heading-6-1920x500.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Lorem ipsum dolor sit amet</h4>
              <h2>Products</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

  

    <div class="products">
      <div class="container">
        <div class="row">
        <?php
        
        require_once 'credentials.php';
        $conn = get_connection();
      $user = json_decode($_SESSION['user'], true);
      $userId = $user['id'];
        $sql = "SELECT * FROM (Favorites INNER JOIN Users ON Users.id = Favorites.user_id) INNER JOIN Beers ON Beers.id = Favorites.beer_id WHERE Users.id = $userId";

        $res = $conn -> query($sql);
        $records = $res -> fetchAll(PDO::FETCH_ASSOC);
        //var_dump($records);
        
        foreach ($records as $record) {

          $prize = $record['price'] == 0 ? "<span style=\"color: red\">Out of stock</span>" : "$".$record['price'];
          // remove from favorites

          $button = "<div class=\"text-center\"><a method=\"POST\" href=\"add_remove_favorite.php?beer_id=".$record['id']."\" class=\"btn btn-danger\">Törlés</a></div>";
          
          echo 
          "
            <div class=\"col-md-4\">
              <div class=\"product-item\">
                <a href=\"product-details.php\"><img src=\"assets/images/".$record['img_url']."\"></a>
                <div class=\"down-content\">
                  <a href=\"product-details.php\"><h4>".$record['label']."</h4></a>
                  <h6>".$prize."</h6>
                  <p>".$record['description']."</p>
                  <div class=\"text-center\">
                    $button
                  </div>
                </div>
              </div>
            </div>
          ";
        }
        // $conn -> close();
        
        $conn = null;
        ?>
        
        </div>
      </div>
    </div>
    <?php 
      include 'elements/footer.php';
    ?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Book Now</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="contact-form">
              <form action="#" id="contact">
                  <div class="row">
                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Pick-up location" required="">
                          </fieldset>
                       </div>

                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Return location" required="">
                          </fieldset>
                       </div>
                  </div>

                  <div class="row">
                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Pick-up date/time" required="">
                          </fieldset>
                       </div>

                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Return date/time" required="">
                          </fieldset>
                       </div>
                  </div>
                  <input type="text" class="form-control" placeholder="Enter full name" required="">

                  <div class="row">
                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Enter email address" required="">
                          </fieldset>
                       </div>

                       <div class="col-md-6">
                          <fieldset>
                            <input type="text" class="form-control" placeholder="Enter phone" required="">
                          </fieldset>
                       </div>
                  </div>
              </form>
           </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary">Book Now</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
  </body>

</html>
