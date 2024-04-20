<?php

require_once('credentials.php');

function redirect($url) {
    header("Location: $url");
    exit();
}

function showError($message) {
    echo $message;
    exit();
}

function hashPassword($password) {
    return sha1($password); // bcrypt would be better
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn = new PDO(
        'mysql:host=localhost;dbname=' . DB_NAME . ';charset=utf8',
        DB_NAME,
        DB_PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    if (isset($_POST['login'])) {
        if (isset($_POST['email'], $_POST['password'])) {
            $email = $_POST['email'];
            $password = hashPassword($_POST['password']);
            $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ? AND password_hash = ?");
            $stmt->execute([$email, $password]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                session_start();
                $_SESSION['user'] = $user;
                setcookie('user', json_encode($user), time() + 3600);
                redirect('index.php');
            } else {
                showError("Sikertelen bejelentkezés!");
            }
        }
    } elseif (isset($_POST['register'])) {
        if (isset($_POST['email'], $_POST['password'], $_POST['passwordConfirmation'], $_POST['username'])) {
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $passwordConfirmation = $_POST['passwordConfirmation'];

            // Credential Check
            if ($password !== $passwordConfirmation) {
                showError("Passwords do not match!");
            }

            if (strlen($password) < 8) {
                showError("Password must be at least 8 characters long!");
            }

            if (strlen($username) < 3) {
                showError("Username must be at least 3 characters long!");
            }
            // End of Credential Check

            $hashedPassword = hashPassword($password);
            $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                showError("Email already registered!");
            }

            $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                showError("User already exists!");
            }
            

            $stmt = $conn->prepare("INSERT INTO Users (email, password_hash, username) VALUES (?, ?, ?)");
            if ($stmt->execute([$email, $hashedPassword, $username])) {
                $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ? AND password_hash = ?");
                $stmt->execute([$email, $hashedPassword]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                session_start();
                $_SESSION['user'] = $user;
                setcookie('user', json_encode($user), time() + 3600);
                redirect('index.php');
            } else {
                showError("Registration failed!");
            }

            // TODO: Ezeket a szornyuen kinezo uzeneteket valahogy szebben kellene megjeleniteni, ez frontend resz Jani, good luck :)
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>