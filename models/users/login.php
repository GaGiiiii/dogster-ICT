<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

if (isset($_POST['login'])) {
    try {
        $usernameOrEmail = $_POST['usernameOrEmail'];
        $password = $_POST['password'];

        $errors = array();

        if (empty($usernameOrEmail)) {
            $errors['usernameOrEmail'] = '<div class="mb-0 error-msg">Please enter username/email.</div>';
        }

        if (empty($password)) {
            $errors['password'] = '<div class="mb-0 error-msg">Please enter password šifru.</div>';
        }

        if (count($errors) == 0) {
            $data = array(
                "usernameOrEmail" => $usernameOrEmail,
                "password" => $password,
            );

            if (loginUser($data, $conn)) {
                http_response_code(200);
                echo json_encode(["message" => "User logged in."]);

                exit;
            } else {
                $errors['wrong_combination'] = '<div class="mb-0 error-msg">Wrong combination.</div>';
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

function loginUser($data, $conn)
{
    try {
        $query = $conn->prepare("SELECT * FROM users WHERE email = :email OR username = :username");
        $query->execute(array(
            ':email' => $data['usernameOrEmail'],
            ':username' => $data['usernameOrEmail'],
        ));

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($data['password'], $user['password'])) {
            $_SESSION['user'] = $user;

            return true;
        }

        return false;
    } catch (PDOException $e) {
        throw $e;
    }
}
