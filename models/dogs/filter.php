<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

if (isset($_POST['submit'])) {
    try {
        $sortValue = $_POST['sortValue'];
        $searchValue = $_POST['searchValue'];

        $perPage = 6;
        $page = $_POST['pagination'];
        $offset = $page * $perPage - $perPage;

        switch ($sortValue) {
            case 1:
                $query = $conn->prepare("SELECT * FROM dogs WHERE name LIKE ? OR breed LIKE ? LIMIT $perPage OFFSET $offset");
                $query->execute(array(
                    "%$searchValue%",
                    "%$searchValue%"
                ));

                $dogs = $query->fetchAll(PDO::FETCH_ASSOC);
                break;
            case 2:
                $query = $conn->prepare("SELECT d.*, COUNT(c.dog_id) AS BROJ_KOM FROM dogs d LEFT JOIN comments c ON c.dog_id = d.id WHERE name LIKE ? OR breed LIKE ? GROUP BY d.id, c.dog_id ORDER BY BROJ_KOM DESC LIMIT $perPage OFFSET $offset");
                $query->execute(array(
                    "%$searchValue%",
                    "%$searchValue%"
                ));

                $dogs = $query->fetchAll(PDO::FETCH_ASSOC);
                break;
            case 3:
                $query = $conn->prepare("SELECT d.*, COUNT(f.dog_id) AS BROJ_FAV FROM dogs d LEFT JOIN favorites f ON f.dog_id = d.id WHERE name LIKE ? OR breed LIKE ? GROUP BY d.id, f.dog_id ORDER BY BROJ_FAV DESC LIMIT $perPage OFFSET $offset");
                $query->execute(array(
                    "%$searchValue%",
                    "%$searchValue%"
                ));

                $dogs = $query->fetchAll(PDO::FETCH_ASSOC);
                break;
        }

        if ($searchValue === "") {
            $query = $conn->prepare("SELECT * FROM `dogs`");
            $query->execute();
            $totalPages = ceil(sizeof($query->fetchAll(PDO::FETCH_ASSOC)) / $perPage);
        } else {
            $totalPages = ceil(sizeof($dogs) / $perPage);
        }

        http_response_code(201);
        echo json_encode(["dogs" => $dogs, 'totalPages' => $totalPages]);

        exit;
    } catch (PDOException $ex) {
        echo json_encode(['errors' => ['db_error' => 'DB Error: ' . $ex->getMessage()]]);
        http_response_code(500);
    }
} else {
    http_response_code(400); // 400 - Bad request
}
