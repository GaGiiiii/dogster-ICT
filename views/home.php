<?php

$query = $conn->prepare("SELECT * FROM `dogs`");
$query->execute();
$dogs = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="row mt-5">
    <?php foreach ($dogs as $dog) : ?>
        <div class="col-md-4 mb-3">
            <div class="card dog-card">
                <a href="<?php echo BASE_URL ?>?page=dogs&id=<?php echo $dog['id']; ?>"><img src="<?php echo $dog['img'] ?>" class="card-img-top"></a>
                <div class="card-body">
                    <a class="dog-name" href="<?php echo BASE_URL ?>?page=dogs&id=<?php echo $dog['id']; ?>">
                        <h5 class="card-title"><?php echo $dog['name']; ?></h5>
                    </a>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $dog['breed']; ?></h6>
                    <p class="card-text"><?php echo $dog['description']; ?></p>
                    <a href="<?php echo BASE_URL ?>?page=dogs&id=<?php echo $dog['id']; ?>" class="btn btn-sm btn-secondary">Read more</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>