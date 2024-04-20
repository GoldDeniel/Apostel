<?php

 // logout, clear session, clear user cookie

session_start();
session_destroy();
setcookie('user', '', time() - 3600);
header('Location: index.php');
