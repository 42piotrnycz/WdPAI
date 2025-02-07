<!DOCTYPE html>
<html>
<head>
    <title>User Reviews</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<div class="reviews-container">
    <h1>Your Reviews</h1>

    <?php if (isset($reviews) && count($reviews) > 0): ?>
        <?php foreach ($reviews as $review): ?>
            <div class="review">
                <h2><?php echo htmlspecialchars($review->getReviewTitle()); ?></h2>
                <p><strong>Title:</strong> <?php echo htmlspecialchars($review->getTitle()); ?></p>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($review->getDescription()); ?></p>
                <p><strong>Rating:</strong> <?php echo $review->getStars(); ?> stars</p>
                <?php if ($review->getImage()): ?>
                    <img src="<?php echo htmlspecialchars($review->getImage()); ?>" alt="Review Image">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You don't have any reviews yet.</p>
    <?php endif; ?>
</div>
</body>
</html>