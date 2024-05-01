<?php

    define('DB_NAME', 'ApostHell');
    define('DB_PASSWORD', 'AVP*)X06nI.*uy)Y');
    session_start();
    // report and write php errors

    function get_connection() {
        return new PDO(
            'mysql:host=localhost;dbname='.DB_NAME.';charset=utf8',
            DB_NAME,
            DB_PASSWORD
        );
    }