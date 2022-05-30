<?php

if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']['is_admin'] == 0)) {
    header("Location: index.php");

    exit;
}

$id = $_GET['id'];

$query = $conn->prepare("SELECT * FROM dogs WHERE id = :id");
$query->execute(array(
    ':id' => $id,
));

$dog = $query->fetch(PDO::FETCH_ASSOC);

?>

<section class="mt-4 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10 col-10 g-0">
                <div class="edit-dog">

                </div>
            </div>
        </div>
    </div>
</section>

<script src="assets/js/api/dogs/dogs.js"></script>