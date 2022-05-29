<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

if (isset($_POST['submit'])) {
    try {
        $dogID = $_POST['dogID'];

        $data = array(
            "dog_id" => $dogID,
            "user_id" => $_SESSION['user']['id'],
        );

        if (addDogToFavorites($data, $conn)) {
            http_response_code(201);
            echo json_encode(["message" => "Dog added to favorites."]);

            exit;
        }

        http_response_code(400);
        echo json_encode(["errors" => $errors]);
    } catch (PDOException $ex) {
        echo json_encode(['errors' => ['db_error' => 'DB Error: ' . $ex->getMessage()]]);
        http_response_code(500);
    }
} else {
    http_response_code(400); // 400 - Bad request
}

function addDogToFavorites($data, $conn)
{
    try {
        $query = $conn->prepare("INSERT INTO favorites (user_id, dog_id) VALUES (?, ?)");

        return $query->execute([
            $data['user_id'],
            $data['dog_id'],
        ]);
    } catch (PDOException $e) {
        throw $e;
    }
}
