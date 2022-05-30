<?php

header('Content-Type: application/json');
require_once '../../config/connection.php';

$pages = [
    'index' => [
        'total' => 0,
        'last24' => 0
    ],
    'admin' => [
        'total' => 0,
        'last24' => 0
    ],
    'about' => [
        'total' => 0,
        'last24' => 0
    ],
    'dogs-edit' => [
        'total' => 0,
        'last24' => 0
    ],
    'dogs' => [
        'total' => 0,
        'last24' => 0
    ],
    'add-new-dog' => [
        'total' => 0,
        'last24' => 0
    ],
    'login' => [
        'total' => 0,
        'last24' => 0
    ],
    'register' => [
        'total' => 0,
        'last24' => 0
    ],
    'profile' => [
        'total' => 0,
        'last24' => 0
    ],
    'admin' => [
        'total' => 0,
        'last24' => 0
    ],
    'logout' => [
        'total' => 0,
        'last24' => 0
    ],
];

$file = fopen("../../data/log.txt", "r");

if ($file) {
    while (($line = fgets($file)) !== false) {
        $lineExploded = explode("\t", $line);
        $page = explode('=', $lineExploded[0])[1];
        $pages[$page]['total']++;
        $date = explode('=', $lineExploded[1])[1];
        $secondsDiff = strtotime(date("Y-m-d H:i:s")) - strtotime($date);
        if ($secondsDiff < 86400) {
            $pages[$page]['last24']++;
        }
    }

    fclose($file);
}

$total = 0;
$total24 = 0;

foreach ($pages as $page) {
    $total += $page['total'];
    $total24 += $page['last24'];
}


$query = $conn->prepare("SELECT * FROM users WHERE last_login >= now() - INTERVAL 1 DAY");
$query->execute();
$users = $query->fetchAlL(PDO::FETCH_ASSOC);

echo json_encode([
    'pages' => $pages,
    'total' => $total,
    'total24' => $total24,
    'users' => $users
]);
