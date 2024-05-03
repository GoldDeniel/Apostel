<?php
    // Megvizsgáljuk az aktuális oldal elérési útját
    $current_page = basename($_SERVER['PHP_SELF']);
?>

<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php"><h2>ApostHell - <em>Pokolian fagyos sör</em></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php if($current_page == 'index.php' && $current_page != 'blog.php' && $current_page != 'testimonials.php' && $current_page != 'terms.php') echo 'active'; ?>"><a class="nav-link" href="index.php">Kezdőlap</a></li>
                    <li class="nav-item <?php if($current_page == 'products.php' && $current_page != 'blog.php' && $current_page != 'testimonials.php' && $current_page != 'terms.php') echo 'active'; ?>"><a class="nav-link" href="products.php">Termékek</a></li>
                    <li class="nav-item <?php if($current_page == 'about-us.php' && $current_page != 'blog.php' && $current_page != 'testimonials.php' && $current_page != 'terms.php') echo 'active'; ?>"><a class="nav-link" href="about-us.php">Rólunk</a></li>
                    <li class="nav-item <?php if($current_page == 'contact.php' && $current_page != 'blog.php' && $current_page != 'testimonials.php' && $current_page != 'terms.php') echo 'active'; ?>"><a class="nav-link" href="contact.php">Kapcsolat</a></li> 
                    <li class="nav-item <?php if($current_page == 'checkout.php' && $current_page != 'blog.php' && $current_page != 'testimonials.php' && $current_page != 'terms.php') echo 'active'; ?>"><a class="nav-link" href="checkout.php">Kosár</a></li>
                    <?php
                    require_once('credentials.php');

                    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
                        echo "<li class=\"nav-item\"><a class=\"nav-link " . (($current_page == 'favorites.php') ? 'active' : '') . "\" href=\"favorites.php\">Kedvencek</a></li>";
                        echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"logout.php\">Kijelentkezés</a></li>";
                    } else {
                        echo "<li class=\"nav-item " . (($current_page == 'authentication_page.php' || $current_page == 'logout.php') ? 'active' : '') . "\">";
                        echo "<a class=\"nav-link\" href=\"authentication_page.php\">Bejelentkezés/Regisztráció</a>";
                        echo "</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
