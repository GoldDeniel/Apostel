<?php
    require_once 'credentials.php';
    $_SESSION['cart'] = [];
    header('Location: checkout.php');
