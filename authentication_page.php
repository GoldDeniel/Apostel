<?php

require_once ('credentials.php');

function login(){
    if (isset($_POST['email']) && isset($_POST['password'])) {
            
            
        $conn = get_connection();
        $sql = "SELECT * FROM Users WHERE email = '{$_POST['email']}' AND password_hash = SHA1('{$_POST['password']}')";
        
        $res = $conn->query($sql);
        $records = $res->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        
        if (count($records) === 1) {
            $_SESSION['is_logged_in'] = true;
            $_SESSION['username'] = $records[0]['username'];
            $_SESSION['email'] = $records[0]['email'];
            $_SESSION['user_id'] = $records[0]['id'];
            
            header('Location: index.php');
        }
        
    }
}
function register(){
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirmation'])) {

        if ($_POST['password'] !== $_POST['passwordConfirmation']) {
            echo 'Passwords do not match!';
            return;
        } 

        if (strlen($_POST['password']) < 8) {
            echo 'Password must be at least 8 characters long!';
            return;
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid email address!';
            return;
        }

        if (strlen($_POST['username']) < 3) {
            echo 'Username must be at least 3 characters long!';
            return;
            
        } 
        $conn = get_connection();
        $sql = "SELECT * FROM Users WHERE email = '{$_POST['email']}' OR username = '{$_POST['username']}'";
        $res = $conn->query($sql);
        $records = $res->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;

        if (count($records) > 0) {
            echo 'Email address or username already in use!';
            return;
        }
        // ezeket at kell vinni javascript-be
        $conn = get_connection();
        $sql = "INSERT INTO Users (username, email, password_hash) VALUES ('{$_POST['username']}', '{$_POST['email']}', SHA1('{$_POST['password']}'))";
        $conn->exec($sql);
        $conn = null;

        login();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    
    if (isset($_POST['login'])) {
        login();
    } elseif (isset($_POST['register'])) {
        register();
    }

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
    <link rel="stylesheet" href="assets/css/style.css">

    <title>ApostHell | Bejelentkezés</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
</head>

<body>
    <!-- Header -->
    <?php include 'elements/header.php'; ?>

<!-- Page Content -->
<div class="page-heading about-heading header-text" style="background-image: url(assets/images/login.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Bejelentkezés/Regisztráció</h4>
              <h2>Légy ügyfelünk</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 register-page">

                <form action="" class="w-50 mx-auto" method="POST" id="loginForm">
                    <h3 class="mt-3">Bejelentkezés</h1>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="">Jelszó</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">
                        Bejelentkezés
                    </button>
                    <span>Még nincs fiókod?</span>
                    <span id="registerSpan" class="btn">
                        Regisztrálj!
                    </span>
                </form>

                <form action="" class="w-50 mx-auto" method="POST" id="registerForm" hidden>
                    <h3 class="mt-3">Regisztráció</h1>
                    <div class="form-group">
                        <label for="">Felhasználónév</label>
                        <input type="text" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="">Jelszó</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="">Jelszó újra:</label>
                        <input type="password" name="passwordConfirmation">
                    </div>
                    <button type="submit" class="btn btn-primary" name="register">
                        Regisztráció
                    </button>
                    <span>Már van fiókod?</span>
                    <span id="loginSpan" class="btn">
                        Jelentkezz be!
                    </span>
                </form>

            </div>
        </div>
    </div>



    <script src="assets/js/register.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>