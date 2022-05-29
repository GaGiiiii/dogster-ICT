<?php

if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['is_admin'] == 0)) {
    header("Location: index.php");

    exit;
}

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

$file = fopen("data/log.txt", "r");

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

?>

<div class="col-md-10 offset-md-1 mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title">Pages statistics</h5>
            <hr>
            <p class="card-text">
            <table class="table text-center table-hover">
                <thead>
                    <tr>
                        <th scope="col">NAME</th>
                        <th scope="col">TOTAL VISITS</th>
                        <th scope="col">LAST 24h VISITS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pages as $pageName => $statistic) : ?>
                        <tr>
                            <td><?php echo $pageName; ?></td>
                            <td><?php echo $statistic['total']; ?> (<?php echo round(($statistic['total'] / $total) * 100, 2) ?>%)</td>
                            <td><?php echo $statistic['last24']; ?> (<?php echo round(($statistic['last24'] / $total24) * 100, 2) ?>%)</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h5 class="card-title">Number of users in last 24h: <?php echo sizeof($users); ?></h5>
            <hr>
            </p>
        </div>
    </div>
</div>