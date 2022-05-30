<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

$user = $_SESSION['user'];


$query = $conn->prepare("SELECT * FROM comments WHERE user_id = :id ORDER BY id DESC");
$query->execute(array(
    ':id' => $user['id'],
));

$comments = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $conn->prepare("SELECT d.name as name, d.breed as breed, d.id as dog_id FROM favorites f JOIN dogs d ON d.id = f.dog_id WHERE user_id = :user_id");
$query->execute(array(
    ':user_id' => $user['id'],
));

$favorites = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    'user' => $user,
    'comments' => $comments,
    'favorites' => $favorites,
]);
