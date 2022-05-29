<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

if (isset($_POST['submit'])) {
    try {
        $commentID = $_POST['commentID'];

        $data = array(
            "commentID" => $commentID,
        );

        if (deleteComment($data, $conn)) {
            http_response_code(200);
            echo json_encode([
                "message" => "Comment deleted.",
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

function deleteComment($data, $conn)
{
    try {
        $query = $conn->prepare("DELETE FROM comments WHERE id = :id LIMIT 1");
        $result = $query->execute(array(':id' => $data['commentID']));

        return $result;
    } catch (PDOException $e) {
        throw $e;
    }
}
