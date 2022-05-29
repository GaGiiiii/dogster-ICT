<?php

if (!isset($_SESSION['user'])) {
    header("Location: index.php");

    exit;
}

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

?>

<div class="col-md-10 offset-md-1 mt-4 mb-5">
    <h1 class="mb-4 text-center">Welcome to your profile page :)</h1>
    <div class="card text-center">
        <div class="card-header">
            <i class="fa fa-user" aria-hidden="true"></i>
            <?php echo $user['username']; ?> | <?php echo $user['email']; ?>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordionExample">

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseComments" aria-expanded="false" aria-controls="collapseComments">
                            <i class="fa fa-comments" aria-hidden="true"></i> &nbsp; <?php echo sizeof($comments); ?> Comments
                        </button>
                    </h2>
                    <div id="collapseComments" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-start">
                            <ul>
                                <?php foreach ($comments as $comment) : ?>
                                    <li><?php echo $comment['body']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fa fa-heart" aria-hidden="true"></i> &nbsp; <?php echo sizeof($favorites); ?> Favorite dogs
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-start">
                            <ul>
                                <?php foreach ($favorites as $favorite) : ?>
                                    <li><a class="text-decoration-none" href="<?php echo BASE_URL ?>?page=dogs&id=<?php echo $favorite['dog_id']; ?>"><?php echo $favorite['name']; ?> (<?php echo $favorite['breed']; ?>)</a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            Joined on: <?php echo $user['created_at']; ?>h
        </div>
    </div>
</div>