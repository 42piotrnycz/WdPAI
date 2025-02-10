<!DOCTYPE html>

<head>
    <title>REVIEWS</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/reviews.css">
</head>

<body>
<?php include 'public/templates/navbar.php'; ?>

<div class="base-container">
    <?php include 'public/templates/messages.php'; ?>
    <div class="review-container">
        <?php if ($review !== null): ?>
            <h3 class="movie-title"><?= htmlspecialchars($review->getTitle()) ?></h3>
            <img class="poster"
                 src="public/uploads/<?php echo htmlspecialchars($review->getImage()); ?>" alt="Review Image">
            <?php include 'public/templates/stars.php'; ?>

            <h4 class="review-title"><?= htmlspecialchars($review->getReviewTitle()) ?></h4>
            <p class="review-description"><?= nl2br(htmlspecialchars($review->getDescription())) ?></p>

            <?php if (isset($_SESSION['userID']) && $_SESSION['userID'] == $review->getUserID()): ?>
                <form class="review-form" action="editReview" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="reviewID" value="<?= htmlspecialchars($review->getReviewID()); ?>">
                    <a href="editReviewPage?id=<?= urlencode($review->getReviewID()); ?>" class="edit-button">Edit</a>
                </form>
                <form action="/deleteReview" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                    <input type="hidden" name="reviewID" value="<?= $review->getReviewID(); ?>">
                    <button type="submit" class="delete-button">Delete</button>
                </form>


<?php endif; ?>
        <?php else: ?>
            <p>No review available</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
