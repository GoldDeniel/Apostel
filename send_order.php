<?php
    require_once 'credentials.php';
    echo "Sending...";
    // if cart is empty, redirect to checkout
    if (count($_SESSION['cart']) == 0) {
        header('Location: checkout.php');
        die();
    }
    echo "Connecting...";
    $conn = get_connection();
    echo "Connected!";
    if(!isset($_SESSION['user_id'])) {
        $user_id = 2;
    } else {
        $user_id = $_SESSION['user_id'];
    }
    echo "User ID: $user_id";
    echo "Inserting order...";
    $sql = "INSERT INTO Orders (id, user_id) VALUES (NULL, '$user_id'); ";
    $res = $conn -> query($sql);
    $order_id = $conn -> lastInsertId();
    echo "Order ID: $order_id";
    
    if ($res !== false)
    foreach ($_SESSION['cart'] as $items => $item) {
        $sql = "INSERT INTO OrderItems (order_id, beer_id, quantity) VALUES ('$order_id', '{$item['beer_id']}', '{$item['quantity']}')";
        $res = $conn -> query($sql);
        if ($res === false) {
            break;
        }
        $_SESSION['cart'] = [];
    }
?>


<!DOCTYPE html>
<html lang="hun">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>ApostHell | Termékek</title>

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
    <div class="page-heading about-heading header-text" style="background-image: url(assets/images/bar_table_3_beers.jpeg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              
        <?php
            if ($res !== false) {
                echo "<h2>Sikeres rendelés!</h2>";
            } else {
                echo "<h2>Hiba történt a rendelés során!</h2>";
            }
        ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  

    <div class="products">
      <div class="container">
        <div class="row">

        
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

    
