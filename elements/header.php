
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.php"><h2>ApostHell - <em>Pokolian fagyos sör</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Kezdőlap</a></li>
                

                <li class="nav-item"><a class="nav-link" href="products.php">Termékek</a></li>

                <li class="nav-item"><a class="nav-link" href="about-us.php">Rólunk</a></li>

                <li class="nav-item active">
                  <a class="nav-link" href="contact.php">Kapcsolat
                    <span class="sr-only">*</span>
                  </a>
                </li> 

                <li class="nav-item"><a class="nav-link" href="checkout.php">Kosár</a></li>

                <?php

                if (isset($_SESSION['user'])) {

                    echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"favorites.php\">Kedvencek</a></li>";
                    echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"logout.php\">Kijelentkezés</a></li>";
                }
                else {
                    echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"authentication_page.php\">Bejelentkezés/Regisztráció</a></li>";
                }
                
                // if (strpos($_SERVER['REQUEST_URI'], 'favorites.php') !== false) {
                //   echo "You are in favorites.php";
                // }

                ?>
            </ul>
          </div>
        </div>
      </nav>
    </header>