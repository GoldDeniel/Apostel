<?php
        
        require_once 'credentials.php';
        $conn = get_connection();
        $conn = get_connection();
        $sql = "SELECT * FROM Beers ORDER BY id";

        $res = $conn -> query($sql);
        $records_beers = $res -> fetchAll(PDO::FETCH_ASSOC);
        //var_dump($records);
        
        // favorite beers of the user
        if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true) {
          $sql = "SELECT * FROM Beers INNER JOIN Favorites ON Beers.id = Favorites.beer_id WHERE Favorites.user_id = (SELECT id FROM Users WHERE username = '$user')";
        }

        function is_product_favorited($product) {
          $conn = get_connection();
          $user = $_SESSION['user_id'];
          if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true) {
            $sql = "SELECT * FROM Favorites WHERE user_id = $user AND beer_id = {$product['id']}";
            $res = $conn -> query($sql);
            $records = $res -> fetchAll(PDO::FETCH_ASSOC);
            return count($records) > 0 ? true : false;
          }


        }


        foreach ($records_beers as $record_beer) {

          $prize = $record_beer['price'] == 0 ? "<span style=\"color: red\">Jelenleg nincs raktáron</span>" : "$".$record_beer['price'];
          
          $button_to_cart = $record_beer['price'] == 0 ? "" : "<button class=\"btn btn-primary add-to-cart-button\" product_id=\"{$record_beer['id']}\">Add to cart</button>";
          $button_to_favorties = 
          is_product_favorited($record_beer) ?
          "<button class=\"btn btn-danger remove-favorite-button\" product_id=\"{$record_beer['id']}\">Remove from favorites</button>" : 
          "<button class=\"btn btn-warning add-to-favorite-button\" product_id=\"{$record_beer['id']}\">Add to favorites</button>" ;

          $num_selector = $record_beer['price'] == 0 ? "" : "        <input type=\"number\" class=\"mb-3 quantity-selector\" min=\"1\" max=\"100\" value=\"1\"  product_id=\"{$record_beer['id']}\">
          ";

          echo 
          "
            <div class=\"col-md-4\">
              <div class=\"product-item\">
                <a href=\"product-details.php\"><img src=\"assets/images/".$record_beer['img_url']."\"></a>
                <div class=\"down-content\">
                  <a href=\"product-details.php\"><h4>".$record_beer['label']."</h4></a>
                  <h6>".$prize."</h6>
                  <p>".$record_beer['description']."</p>
                  $num_selector
                  $button_to_cart
                  ";
                  if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true) {
                    echo $button_to_favorties;
                  }
                  echo "
                </div>
              </div>
            </div>
          ";
        }
        echo "<script src=\"assets/js/product_list.js\"></script>";
        // $conn -> close();
        
        $conn = null;
        