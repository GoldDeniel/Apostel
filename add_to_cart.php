<?php
    require_once 'credentials.php';

    $data = json_decode(file_get_contents("php://input"), true);
    $beer_id = $data['beer_id'];
    $quantity = $data['quantity'];
    
    if ($beer_id !== null && $quantity !== null) {

        $product_id = $beer_id;
        $product_amount = $quantity;

        // get cart array from session
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $found = false;
        // check elements are already if cart, if they are, update quantity
        foreach ($cart as $key => $value) {
            if ($value['beer_id'] == $product_id) {
                $cart[$key]['quantity'] = $product_amount;
                $found = true;
                break;
            }
        }
        if (!$found){
            array_push($cart, ['beer_id' => $product_id, 'quantity' => $quantity]);
        }

        // save cart array to session
        $_SESSION['cart'] = $cart;
        $response['success'] = true;
    }
    else {
        $response['error'] = 'No beer_id or quantity provided';
    }
    echo json_encode($cart);


