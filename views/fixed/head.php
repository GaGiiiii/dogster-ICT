<?php

$query = $conn->prepare("SELECT * FROM `navigations`");
$query->execute();
$navigations = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title> Dogster </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Dogster <img class="dog-logo" src="assets/images/dog.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php foreach ($navigations as $navigation) : ?>
                        <?php if ($navigation['page_name'] == "Home" || $navigation['page_name'] == "About me") { ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?php echo $navigation['page_link']; ?>"><?php echo $navigation['page_name']; ?></a>
                            </li>
                        <?php } ?>
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['is_admin'] == 1 && $navigation['page_name'] == "Add New Dog") { ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?php echo $navigation['page_link']; ?>"><?php echo $navigation['page_name']; ?></a>
                            </li>
                        <?php } ?>
                    <?php endforeach; ?>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if (!isset($_SESSION['user'])) { ?>
                        <?php foreach ($navigations as $navigation) : ?>
                            <?php if ($navigation['page_name'] == "Login" || $navigation['page_name'] == "Register") { ?>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="<?php echo $navigation['page_link']; ?>"><?php echo $navigation['page_name']; ?></a>
                                </li>
                            <?php } ?>
                        <?php endforeach; ?>
                    <?php } ?>
                    <?php if (isset($_SESSION['user'])) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['user']['username']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php foreach ($navigations as $navigation) : ?>
                                    <?php if ($navigation['page_name'] == "Profile" || $navigation['page_name'] == "Logout") { ?>
                                        <li class="nav-item">
                                            <a class="dropdown-item" aria-current="page" href="<?php echo $navigation['page_link']; ?>"><?php echo $navigation['page_name']; ?></a>
                                        </li>
                                    <?php } ?>
                                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['is_admin'] == 1 && $navigation['page_name'] == "Admin") { ?>
                                        <li><a class="dropdown-item" href="<?php echo $navigation['page_link']; ?>">Admin panel</a></li>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">