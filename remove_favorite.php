<?php

include 'credentials.php';

$conn = get_connection();

// Send a JSON response
header('Content-Type: application/json');

$response = ['success' => false];

// create $beerid from json from post request
$data = json_decode(file_get_contents("php://input"), true);
$beerid = $data['beer_id'];

if ($beerid !== null) {
    
    $userid = 1; // Retrieve the user from the session
    //$sql = "INSERT INTO Favorites (user_id, beer_id) VALUES ({$_SESSION['user_id']}, $beerid)";
    $sql = "DELETE FROM Favorites WHERE user_id = $userid AND beer_id = $beerid";
    $result = $conn->query($sql);
    $conn = null;

    if ($result) {
        $response['success'] = true;
    } else {
        $response['error'] = 'Database query failed';
    }
} else {
    $response['error'] = 'No beer_id provided';
}

echo json_encode($response);