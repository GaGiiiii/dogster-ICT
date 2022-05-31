<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

if (isset($_POST['submit'])) {
    try {
        $breed = $_POST['breed'];
        $dogID = $_POST['dogID'];
        $name = $_POST['name'];
        $breedDescription = $_POST['breedDescription'];
        $noIMG = false;

        $errors = array();

        if (empty($breed)) {
            $errors['breed'] = '<div class="mb-0 error-msg">Please enter breed.</div>';
        }

        if (empty($name)) {
            $errors['name'] = '<div class="mb-0 error-msg">Please enter name.</div>';
        }

        if (empty($breedDescription)) {
            $errors['breedDescription'] = '<div class="mb-0 error-msg">Please enter breed name.</div>';
        }

        if (empty($_FILES['breedImage'])) {
            $noIMG = true;
        }

        if (!empty($_FILES['breedImage']['name'])) { // Da li je poslao neke fajlove
            $file = $_FILES['breedImage'];

            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $file_name_new = $file_name;

            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/assets/images/dogs')) {
                mkdir($_SERVER['DOCUMENT_ROOT'] . '/assets/images/dogs');
            }

            $file_destination = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/dogs/' . $file_name_new;
            move_uploaded_file($file_tmp, $file_destination);
            $file_destination = 'assets/images/dogs/' . $file_name_new;
        }

        if (count($errors) == 0) {
            $data = array(
                "breed" => $breed,
                "name" => $name,
                "breedDescription" => $breedDescription,
                "breedImage" => $file_destination ?? false,
                "dogID" => $dogID,
            );

            if (updateDog($data, $conn)) {
                http_response_code(200);
                echo json_encode(["message" => "Dog updated."]);

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

function updateDog($data, $conn)
{
    try {
        if ($data['breedImage'] !== false) {
            $query = $conn->prepare("UPDATE dogs SET name = ?, breed = ?, description = ?, img = ? WHERE id = ?");
            $result = $query->execute([
                $data['name'],
                $data['breed'],
                $data['breedDescription'],
                $data['breedImage'],
                $data['dogID'],
            ]);

            return $result;
        }

        $query = $conn->prepare("UPDATE dogs SET name = ?, breed = ?, description = ? WHERE id = ?");
        $result = $query->execute([
            $data['name'],
            $data['breed'],
            $data['breedDescription'],
            $data['dogID'],
        ]);

        return $result;
    } catch (PDOException $e) {
        throw $e;
    }
}
