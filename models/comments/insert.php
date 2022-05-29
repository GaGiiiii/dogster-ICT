<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

if (isset($_POST['submit'])) {
    try {
        $comment = $_POST['comment'];
        $dog_id = $_POST['dog_id'];

        $errors = array();

        if (empty($comment)) {
            $errors['comment'] = '<div class="mb-0 error-msg">Please enter comment.</div>';
        }

        if (count($errors) == 0) {
            $data = array(
                "comment" => $comment,
                'user_id' => $_SESSION['user']['id'],
                'dog_id' => $dog_id
            );

            if (addComment($data, $conn)) {
                http_response_code(201);
                echo json_encode([
                    "message" => "Comment added.",
                    'comment' => selectLastComment($_SESSION['user']['id'], $conn)
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

function addComment($data, $conn)
{
    try {
        $query = $conn->prepare("INSERT INTO comments (user_id, dog_id, body) VALUES (?, ?, ?)");

        return $query->execute([
            $data['user_id'],
            $data['dog_id'],
            $data['comment'],
        ]);
    } catch (PDOException $e) {
        throw $e;
    }
}

function selectLastComment($userID, $conn)
{
    try {
        $query = $conn->prepare("SELECT c.*, u.username, u.id AS UID
        FROM comments c 
        JOIN users u 
        ON u.id = c.user_id 
        WHERE u.id = :id 
        ORDER BY c.id DESC 
        LIMIT 1");
        $query->execute(array(
            ':id' => $userID,
        ));

        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw $e;
    }
}
