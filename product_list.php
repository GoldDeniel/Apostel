<?php
        
        require_once 'credentials.php';
        $conn = new PDO(
          'mysql:host=localhost;dbname='.DB_NAME.';charset=utf8',
          DB_NAME,
          DB_PASSWORD
      );
        $sql = "SELECT * FROM Beers ORDER BY id";

        $res = $conn -> query($sql);
        $records = $res -> fetchAll(PDO::FETCH_ASSOC);
        //var_dump($records);
        
        foreach ($records as $record) {

          $prize = $record['price'] == 0 ? "<span style=\"color: red\">Jelenleg nincs raktáron</span>" : "$".$record['price'];

          echo 
          "
            <div class=\"col-md-4\">
              <div class=\"product-item\">
                <a href=\"product-details.php\"><img src=\"assets/images/".$record['img_url']."\"></a>
                <div class=\"down-content\">
                  <a href=\"product-details.php\"><h4>".$record['label']."</h4></a>
                  <h6>".$prize."</h6>
                  <p>".$record['description']."</p>
                </div>
              </div>
            </div>
          ";
        }
        // $conn -> close();
        
        $conn = null;
        