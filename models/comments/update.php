<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

if (isset($_POST['submit'])) {
    try {
        $comment = $_POST['comment'];
        $commentID = $_POST['commentID'];

        $errors = array();

        if (empty($comment)) {
            $errors['comment'] = '<div class="mb-0 error-msg">Please enter comment.</div>';
        }

        if (count($errors) == 0) {
            $data = array(
                "comment" => $comment,
                "commentID" => $commentID,
            );

            if (updateComment($data, $conn)) {
                http_response_code(201);
                echo json_encode([
                    "message" => "Comment updated.",
                ]);

                exit;
            }
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

function updateComment($data, $conn)
{
    try {
        $query = $conn->prepare("UPDATE comments SET body = ? WHERE id = ?");
        $result = $query->execute([
            $data['comment'],
            $data['commentID'],
        ]);

        return $result;
    } catch (PDOException $e) {
        throw $e;
    }
}
