<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viewing Review...</title>
    <link rel="stylesheet" href="public/css/review.css">
</head>

<body>
<?php include 'public/templates/navbar.php'; ?>

<div class="base-container">
    <?php include 'public/templates/messages.php'; ?>

    <?php if ($review !== null): ?>
        <div class="review-container">
            <h3 class="movie-title"><?= htmlspecialchars($review->getTitle()) ?></h3>
            <img class="poster" src="public/uploads/<?= htmlspecialchars($review->getImage()); ?>" alt="Review Image">

            <?php include 'public/templates/stars.php'; ?>

            <h4 class="review-title"><?= htmlspecialchars($review->getReviewTitle()) ?></h4>
            <p class="review-description"><?= nl2br(htmlspecialchars($review->getDescription())) ?></p>

            <?php if (isset($_SESSION['userID']) && $_SESSION['userID'] == $review->getUserID()): ?>
            <div class="buttons-container">
                <form action="editReview" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="reviewID" value="<?= htmlspecialchars($review->getReviewID()); ?>">
                    <a href="editReviewPage?id=<?= urlencode($review->getReviewID()); ?>" class="edit-button">Edit</a>
                </form>
                <form action="/deleteReview" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                    <input type="hidden" name="reviewID" value="<?= $review->getReviewID(); ?>">
                    <button type="submit" class="delete-button">Delete</button>
                </form>
            </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p>No review available</p>
    <?php endif; ?>
</div>
</body>

</html>
