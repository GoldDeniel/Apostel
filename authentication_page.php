<?php

    require_once('credentials.php');  

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<body>
    <?php include 'elements/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="" class="w-50 mx-auto" method="POST">
                    <h3 class="mt-3">Login</h1>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>