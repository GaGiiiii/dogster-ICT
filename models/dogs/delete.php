<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

if (isset($_POST['submit'])) {
    try {
        $dogID = $_POST['dogID'];

        $data = array(
            "dogID" => $dogID,
        );

        if (deleteDog($data, $conn)) {
            http_response_code(200);
            echo json_encode([
                "message" => "Dog deleted.",
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

function deleteDog($data, $conn)
{
    try {
        $query = $conn->prepare("DELETE FROM dogs WHERE id = :id LIMIT 1");
        $result = $query->execute(array(':id' => $data['dogID']));

        return $result;
    } catch (PDOException $e) {
        throw $e;
    }
}
