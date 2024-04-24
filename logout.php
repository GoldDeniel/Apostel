<?php

 // logout, clear session, clear user cookie
 require_once ('credentials.php');

session_destroy();
header('Location: index.php');
