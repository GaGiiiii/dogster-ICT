<?php

$query = $conn->prepare("SELECT * FROM `dogs`");
$query->execute();
$dogs = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="row mt-5">
    <div class="mb-3">
        <div class="d-flex w-50">
            <div>
                <label for="">Sort by</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Date</option>
                    <option value="1">Most Comments</option>
                    <option value="2">Most Likes</option>
                </select>
            </div>
            <div class="ms-2">
                <label for="">Search</label>
                <input class="form-control me-2 search-input" type="search" placeholder="Search" aria-label="Search">
            </div>
        </div>
    </div>
    <?php foreach ($dogs as $dog) : ?>
        <div class="col-md-4 mb-3">
            <div class="card dog-card">
                <a href="<?php echo BASE_URL ?>?page=dogs&id=<?php echo $dog['id']; ?>"><img class="img-thumbnail" width="100%" src="<?php echo $dog['img'] ?>" class="card-img-top"></a>
                <div class="card-body">
                    <a class="dog-name" href="<?php echo BASE_URL ?>?page=dogs&id=<?php echo $dog['id']; ?>">
                        <h5 class="card-title"><?php echo $dog['name']; ?></h5>
                    </a>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $dog['breed']; ?></h6>
                    <p class="card-text"><?php echo substr($dog['description'], 0, 250); ?>....</p>
                    <a href="<?php echo BASE_URL ?>?page=dogs&id=<?php echo $dog['id']; ?>" class="btn btn-sm btn-secondary">Read more</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>