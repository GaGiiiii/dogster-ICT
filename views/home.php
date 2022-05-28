<?php

$query = $conn->prepare("SELECT * FROM `dogs`");
$query->execute();
$dogs = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="row mt-5">
    <?php foreach ($dogs as $dog) : ?>
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="<?php echo $dog['img'] ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $dog['name']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $dog['breed']; ?></h6>
                    <p class="card-text"><?php echo $dog['description']; ?></p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>