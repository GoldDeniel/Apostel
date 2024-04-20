<?php

    require_once('credentials.php');  

    if (isset($_POST['login'])){
        
        if (isset($_POST['email']) && isset($_POST['password']))
        {

            $conn = new PDO(
                'mysql:host=localhost;dbname='.DB_NAME.';charset=utf8',
                DB_NAME,
                DB_PASSWORD
            );
            $email = $_POST['email'];
            $password = SHA1($_POST['password']);
            $sql = "SELECT * FROM Users WHERE email = '$email' AND password_hash  = '$password'"; 
            $res = $conn -> query($sql);
            $records = $res -> fetchAll(PDO::FETCH_ASSOC);
            if (count($records) > 0)
            {
                session_start();
                $_SESSION['user'] = $records[0];
                header('Location: index.php');
                setcookie('user', json_encode($records[0]), time() + 3600);
            }
            else
            {
                echo "Sikertelen bejelentkezés!";
            }
            $conn = null;
        }
    } else if (isset($_POST['register'])) {


        // Registration logic
        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirmation']) && isset($_POST['username']) ) {
            
            $conn = new PDO( 
                'mysql:host=localhost;dbname=' . DB_NAME . ';charset=utf8',
                DB_NAME,
                DB_PASSWORD
            );
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = SHA1($_POST['password']); // bcrypt would be better tho

            // **** CREDENTIAL CHECK ****

            if ($_POST['password'] !== $_POST['passwordConfirmation']) {
                echo "Passwords do not match!";
                return;
            }

            if (strlen($_POST['password']) < 8) {
                echo "Password must be at least 8 characters long!";
                return;
            }

            if (strlen($_POST['username']) < 3) {
                echo "Username must be at least 3 characters long!";
                return;
            }

            // **** END OF CREDENTIAL CHECK ****

            // check if user already exists
            $sql = "SELECT * FROM Users WHERE email = '$email'";
            $res = $conn->query($sql);
            $records = $res->fetchAll(PDO::FETCH_ASSOC);
            

            if (count($records) > 0) {
                echo "User already exists!";
                return;
            }

            $sql = "INSERT INTO Users (email, password_hash, username) VALUES ('$email', '$password', '$username')";
            $result = $conn->exec($sql);
            if ($result !== false) {

                // Login the user after registration
                $sql = "SELECT * FROM Users WHERE email = '$email' AND password_hash  = '$password'";
                $res = $conn -> query($sql);
                $records = $res -> fetchAll(PDO::FETCH_ASSOC);
                session_start();
                $_SESSION['user'] = $records[0];
                setcookie('user', json_encode($records[0]), time() + 3600);

                header('Location: index.php');
            } else {
                echo "Registration failed!"; // TODO: Tell the user in a nicer way
            }
            $conn = null;
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
    <link rel="stylesheet" href="/assets/css/style.css">
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
    


    <script src="/assets/js/register.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>