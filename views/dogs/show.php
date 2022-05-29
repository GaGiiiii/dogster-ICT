<?php

$id = $_GET['id'];

$query = $conn->prepare("SELECT * FROM dogs WHERE id = :id");
$query->execute(array(
    ':id' => $id,
));

$dog = $query->fetch(PDO::FETCH_ASSOC);


$query = $conn->prepare("SELECT c.*, u.username, u.id AS UID FROM comments c JOIN users u ON u.id = c.user_id WHERE dog_id = :id ORDER BY c.id DESC");
$query->execute(array(
    ':id' => $id,
));

$comments = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $conn->prepare("SELECT * FROM favorites WHERE dog_id = :dog_id");
$query->execute(array(
    ':dog_id' => $id,
));

$favorites = $query->fetchAll(PDO::FETCH_ASSOC);


$query = $conn->prepare("SELECT * FROM favorites WHERE user_id = :user_id AND dog_id = :dog_id");
$query->execute(array(
    ':user_id' => $_SESSION['user']['id'] ?? -1,
    ':dog_id' => $id,
));

$favorite = $query->fetch(PDO::FETCH_ASSOC);
$favorite = $favorite ? true : false;

?>

<div class="row mt-5">
    <div class="col-md-8 mb-3 offset-md-2">
        <img src="<?php echo $dog['img'] ?>" class="card-img-top">
        <div class="card dog-card-show">
            <div class="card-body">
                <div class="text-center">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    Admin &nbsp;
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    Created at: <?php echo $dog['created_at']; ?>h &nbsp;
                    <i class="fa fa-comments" aria-hidden="true"></i>
                    <span class="number-of-comments"> <?php echo sizeof($comments); ?></span> comments &nbsp;
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <span class="number-of-favorites"> <?php echo sizeof($favorites); ?></span> favorites
                </div>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['is_admin']) { ?>
                    <div class="text-center mt-2">
                        <a class="btn btn-sm btn-warning" href="<?php echo BASE_URL ?>?page=dogs-edit&id=<?php echo $dog['id']; ?>">Edit</a>
                        <button data-dog-id="<?php echo $dog['id']; ?>" class="btn btn-sm btn-danger delete-dog">Delete</button>
                    </div>
                <?php  } ?>
                <hr>
                <h4 class="card-title"><?php echo $dog['name']; ?></h4>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $dog['breed']; ?></h6>

                <p class="card-text"><?php echo $dog['description']; ?></p>
                <hr>
                <div data-favorite="<?php echo $favorite; ?>" data-dog-id="<?php echo $dog['id']; ?>" class="text-center add-to-favorites">
                    <?php if ($favorite) { ?>
                        <i class="fa fa-heart" aria-hidden="true"></i> Remove from favorites <i class="fa fa-heart" aria-hidden="true"></i>
                    <?php } else { ?>
                        <i class="fa fa-heart" aria-hidden="true"></i> Add to favorites <i class="fa fa-heart" aria-hidden="true"></i>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div id="comments" class="mt-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="mt-1">
                        <i class="fa fa-comment" aria-hidden="true"></i> Comments
                    </div>
                    <div>
                        <button class="btn btn-sm btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Add New Comment
                        </button>

                    </div>
                </div>
                <div class="collapse" id="collapseExample">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <div class="card card-body">
                            <div id="comment-errors" class="mb-3"></div>
                            <form id="submit-new-comment-form">
                                <input type="hidden" name="dog_id" value="<?php echo $dog['id']; ?>">
                                <div class="mb-4">
                                    <label class="form-label">Comment <strong class="text-danger">*</strong></label>
                                    <textarea class="form-control" name="comment" placeholder="Enter comment" id="floatingTextarea2" style="height: 100px"></textarea>
                                    <?php echo $errors['comment'] ?? ""; ?>
                                </div>
                                <button name="register" type="submit" class="btn btn-secondary w-100">Submit</button>
                            </form>
                        </div>
                    <?php } else { ?>
                        <div class="card card-body card-please-login">
                            <p class="mb-0">Please <a href="<?php echo BASE_URL ?>?page=login">login</a> to leave a comment.</p>
                        </div>
                    <?php } ?>
                </div>
                <div class="card-body all-comments">
                    <?php foreach ($comments as $comment) : ?>
                        <div data-div-comment-id="<?php echo $comment['id']; ?>" class="comment mb-2">
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <i class="fa fa-user" aria-hidden="true"></i> <?php echo $comment['username']; ?> &nbsp;
                                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $comment['UID']) { ?>
                                        <button class="btn btn-sm btn-outline-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample_<?php echo $comment['id']; ?>" aria-expanded="false" aria-controls="collapseExample_<?php echo $comment['id']; ?>">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>
                                        <button data-comment-id="<?php echo $comment['id']; ?>" class="btn btn-sm btn-outline-danger delete-comment"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    <?php } ?>
                                </div>
                                <div>Created at: <?php echo $comment['created_at']; ?></div>
                            </div>
                            <p data-comment-id="<?php echo $comment['id']; ?>" class="card-text"><?php echo $comment['body']; ?></p>
                            <div class="collapse" id="collapseExample_<?php echo $comment['id']; ?>">
                                <textarea data-comment-id="<?php echo $comment['id']; ?>" class="form-control" placeholder="Leave a comment here" style="height: 100px"><?php echo $comment['body']; ?></textarea>
                                <button data-comment-id="<?php echo $comment['id']; ?>" class="btn btn-warning mt-3 edit-comment">Edit</button>
                            </div>
                            <hr>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/api/comments/comments.js"></script>
<script src="assets/js/api/dogs/dogs.js"></script>
<script src="assets/js/api/favorites/favorites.js"></script>