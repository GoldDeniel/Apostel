<?php
// credentials.php megadása
require_once 'credentials.php';

// JSON adatok feldolgozása
$data = json_decode(file_get_contents("php://input"), true);
$beer_id = $data['beer_id'];

// Ha meg van adva a beer_id
if ($beer_id !== null) {

    // Kosár tömbjének lekérése a sessionből
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    
    // Tárgy eltávolítása a kosárból
    foreach ($cart as $key => $value) {
        if ($value['beer_id'] == $beer_id) {
            unset($cart[$key]);
            break;
        }
    }

    // Kosár tömbjének újrarendezése
    $cart = array_values($cart);

    // Kosár tömbjének újratárolása a sessionben
    $_SESSION['cart'] = $cart;

    $response['success'] = true;
    $response['message'] = 'Item removed from cart.';
} else {
    $response['error'] = 'No beer_id provided';
}

echo json_encode($response);
?>
