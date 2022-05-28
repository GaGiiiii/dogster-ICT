<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

if (isset($_POST['register'])) {
    try {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $username = $_POST['username'];
        $birthday = $_POST['birthday'];

        $errors = array();

        if (empty($email)) {
            $errors['email'] = '<div class="mb-0 error-msg">Please enter email.</div>';
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = '<div class="mb-0 error-msg">Wrong email format.</div>';
            }
        }

        if (empty($birthday)) {
            $birthday = null;
        }

        if (empty($password)) {
            $errors['password'] = '<div class="mb-0 error-msg">Please enter password šifru.</div>';
        } else {
            if ($password != $confirmPassword) {
                $errors['password_confirm'] = '<div class="mb-0 error-msg">Passwords do not match.</div>';
            } else {
                if (empty($confirmPassword)) {
                    $errors['confirmPassword'] = '<div class="mb-0 error-msg">Please confirm password.</div>';
                }
            }
        }

        if (empty($username)) {
            $errors['username'] = '<div class="mb-0 error-msg">Please enter username.</div>';
        } else {
            if (!ctype_alnum($username)) {
                $errors['username'] = '<div class="mb-0 error-msg">Only letters and numbers allowed.</div>';
            }
        }

        if (count($errors) == 0) {
            $data = array(
                "email" => $email,
                "password" => $password,
                "username" => $username,
                "birthday" => $birthday,
            );

            if (takenEmail($email, $conn)) {
                $errors['taken_email'] = '<div class="alert alert-danger alert-dismissible show" role="alert">
                    <strong>Error!</strong> Email is taken.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } elseif (takenUsername($username, $conn)) {
                $errors['taken_username'] = '<div class="alert alert-danger alert-dismissible show" role="alert">
                <strong>Error!</strong> Username is taken.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            } elseif (registerUser($data, $conn)) {
                http_response_code(201);
                echo json_encode(["message" => "User registered."]);

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

function takenEmail($email, $conn)
{
    try {
        $query = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute(array(
            ':email' => $email,
        ));

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return true;
        }

        return false;
    } catch (PDOException $e) {
        throw $e;
    }
}

function takenUsername($username, $conn)
{
    try {
        $query = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $query->execute(array(
            ':username' => $username,
        ));

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return true;
        }

        return false;
    } catch (PDOException $e) {
        throw $e;
    }
}

function registerUser($data, $conn)
{
    try {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT); // Hashovanje sifre sa md5
        $query = $conn->prepare("INSERT INTO users (email, password, username, birthday) VALUES (?, ?, ?, ?)");
        $result = $query->execute([
            $data['email'],
            $data['password'],
            $data['username'],
            $data['birthday'] ?? null,
        ]);

        $data['id'] = $conn->lastInsertId();
        $data['is_admin'] = false;

        // $data = $this->fixData($data);

        if ($result) { // Ukoliko je query uspesan pravimo sesiju i vracamo true
            $_SESSION['user'] = $data;

            return true;
        }

        return false;
    } catch (PDOException $e) {
        throw $e;
    }
}
