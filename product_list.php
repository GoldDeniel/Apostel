<?php
        
        require_once 'credentials.php';
        $conn = get_connection();
        $sql = "SELECT * FROM Beers ORDER BY id";

        $res = $conn -> query($sql);
        $records = $res -> fetchAll(PDO::FETCH_ASSOC);
        //var_dump($records);
        
        foreach ($records as $record) {

          $prize = $record['price'] == 0 ? "<span style=\"color: red\">Out of stock</span>" : "$".$record['price'];
          
          $button_to_cart = $record['price'] == 0 ? "" : "<button class=\"btn btn-primary add-to-cart-button\" product_id=\"{$record['id']}\">Add to cart</button>";
          $button_to_favorties = "<button class=\"btn btn-warning add-to-favorites-button\" product_id=\"{$record['id']}\">Add to favorites</button>";
          $num_selector = $record['price'] == 0 ? "" : "        <input type=\"number\" class=\"mb-3\" min=\"1\" max=\"100\" value=\"1\" class=\"quantity-selector\" product_id=\"{$record['id']}\">
          ";

          echo 
          "
            <div class=\"col-md-4\">
              <div class=\"product-item\">
                <a href=\"product-details.php\"><img src=\"assets/images/".$record['img_url']."\"></a>
                <div class=\"down-content\">
                  <a href=\"product-details.php\"><h4>".$record['label']."</h4></a>
                  <h6>".$prize."</h6>
                  <p>".$record['description']."</p>
                  $num_selector
                  $button_to_cart
                  $button_to_favorties
                </div>
              </div>
            </div>
          ";
        }
        echo "<script src=\"assets/js/product_list.js\"></script>";
        // $conn -> close();
        
        $conn = null;
        