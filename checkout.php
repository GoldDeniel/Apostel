<!DOCTYPE html>
<html lang="hun">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>ApostHell | Kosár</title>

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
    <div class="page-heading about-heading header-text" style="background-image: url(assets/images/cart_back.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Bevásárló kosár</h4>
              <h2>Kiválasztott termékek</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="products call-to-action">
      <div class="container">
        <ul class="list-group list-group-flush">  

        <?php
          require_once "credentials.php";
echo "<h1>A kosar tartalma</h1>";
        if(isset($_SESSION['cart'])) {

          $total = 0;
          $conn = get_connection();
          foreach($_SESSION['cart'] as $key => $value) {
            //echo $value["beer_id"];

               $sql = "SELECT * FROM Beers WHERE id = {$value["beer_id"]}";
               $res = $conn->query($sql);
               $records = $res->fetchAll(PDO::FETCH_ASSOC);
               $total += $records[0]['price'];
               ?>

               <li class="list-group-item">
               <div class="row">
                     <div class="col-6">
                          <em><?php echo $records[0]['label']; ?></em>
                     </div>
                     
                     <div class="col-6 text-right">
                          <strong>$ <?php echo $records[0]['price'];?></strong>
                     </div>
                </div>
             </li>
               <?php
          }
     }
        ?>

          

          <li class="list-group-item">
               <div class="row">
                    <div class="col-6">
                         <h5><em>Végösszeg</em></h5>
                    </div>

                    <div class="col-6 text-right">
                         <h5><strong>$ <?php echo $total?></strong></h5>
                    </div>
               </div>
          </li>
          <a href="empty_cart.php" class="btn btn-danger">Kosár ürítése</a>

        </ul>

        <br>
        
        <div class="inner-content">
          <div class="contact-form">
              <form action="#">
                   <div class="row">
                        <div class="col-sm-6 col-xs-12">
                             <div class="form-group">
                                  <label class="control-label">Titulus:</label>
                                  <select class="form-control" data-msg-required="This field is required.">
                                       <option value="">-- Kérem, válasszon! --</option>
                                       <option value="dr">Dr.</option>
                                       <option value="other">Egyéb</option>
                                       <option value="prof">Prof.</option>
                                  </select>
                             </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                             <div class="form-group">
                                  <label class="control-label">Név:</label>
                                  <input type="text" class="form-control">
                             </div>
                        </div>
                   </div>
                   <div class="row">
                        <div class="col-sm-6 col-xs-12">
                             <div class="form-group">
                                  <label class="control-label">E-mail:</label>
                                  <input type="text" class="form-control">
                             </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                             <div class="form-group">
                                  <label class="control-label">Telefonszám:</label>
                                  <input type="text" class="form-control">
                             </div>
                        </div>
                   </div>
                   <div class="row">
                        <div class="col-sm-6 col-xs-12">
                             <div class="form-group">
                                  <label class="control-label">Lakcím:</label>
                                  <input type="text" class="form-control">
                             </div>
                        </div>
                   </div>
                   <div class="row">
                        <div class="col-sm-6 col-xs-12">
                             <div class="form-group">
                                  <label class="control-label">Település:</label>
                                  <input type="text" class="form-control">
                             </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                             <div class="form-group">
                                  <label class="control-label">Vármegye:</label>
                                  <input type="text" class="form-control">
                             </div>
                        </div>
                   </div>
                   <div class="row">
                        <div class="col-sm-6 col-xs-12">
                             <div class="form-group">
                                  <label class="control-label">Irányítószám:</label>
                                  <input type="text" class="form-control">
                             </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                             <div class="form-group">
                                  <label class="control-label">Ország:</label>
                                  <select class="form-control">
                                   <option value="">-- Kérem, válasszon! --</option>
                                       <option value="">Magyarország</option>
                                       <option value="">Horvátország</option>
                                       <option value="">Szlovákia</option>
                                       <option value="">Ukrajna</option>
                                       <option value="">Románia</option>
                                       <option value="">Szlovénia</option>
                                       <option value="">Ausztria</option>
                                  </select>
                             </div>
                        </div>
                   </div>

                   <div class="row">
                        <div class="col-sm-6 col-xs-12">
                             <div class="form-group">
                                  <label class="control-label">Fizetési mód</label>

                                  <select class="form-control">
                                       <option value="">-- Kérem, válasszon! --</option>
                                       <option value="bank">Bankkártya</option>
                                       <option value="cash">Készpénz</option>
                                       <option value="paypal">PayPal</option>
                                  </select>
                             </div>
                        </div>

                   </div>

                   <div class="form-group">
                        <label class="control-label">
                             <input type="checkbox">

                             Elfogadom az <a href="terms.php" target="_blank">Általános &amp; Szerződési Feltételeket</a>
                        </label>
                   </div>

                   <div class="clearfix">
                        <button type="button" class="filled-button pull-left">Vissza</button>
                        
                        <button type="submit" class="filled-button pull-right">Megrendelés</button>
                   </div>
              </form>
          </div>
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
