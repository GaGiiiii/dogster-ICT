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

        if (deleteFromFavorites($data, $conn)) {
            http_response_code(200);
            echo json_encode([
                "message" => "Favorite deleted.",
            ]);

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

function deleteFromFavorites($data, $conn)
{
    try {
        $query = $conn->prepare("DELETE FROM favorites WHERE user_id = :user_id AND dog_id = :dog_id");
        $result = $query->execute(array(
            ':user_id' => $data['user_id'],
            ':dog_id' => $data['dog_id']
        ));

        return $result;
    } catch (PDOException $e) {
        throw $e;
    }
}
