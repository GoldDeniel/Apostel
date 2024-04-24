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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include 'elements/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-12 register-page">

                <form action="" class="w-50 mx-auto" method="POST" id="loginForm">
                    <h3 class="mt-3">Login</h1>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password">
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">
                            Login
                        </button>
                        <span>Don't have an account?</span>
                        <span id="registerSpan" class="btn">
                            Register
                        </span>
                </form>

                <form action="" class="w-50 mx-auto" method="POST" id="registerForm" hidden>
                    <h3 class="mt-3">Register</h1>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" id="username">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="">Password confirmation:</label>
                            <input type="password" name="passwordConfirmation">
                        </div>
                        <button type="submit" class="btn btn-primary" name="register">
                            Register
                        </button>
                        <span>Already have an account?</span>
                        <span id="loginSpan" class="btn">
                            Login
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