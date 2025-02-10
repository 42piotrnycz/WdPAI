<!DOCTYPE html>
<html>
<head>
    <title>User Reviews</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/reviews.css">
</head>
<body>
<?php include 'public/templates/navbar.php'; ?>
<div class="reviews-grid">
    <?php if (isset($reviews) && count($reviews) > 0): ?>
        <?php foreach ($reviews as $review): ?>
            <div class="review-container">
                <a href="review?id=<?php echo urlencode($review->getReviewID()); ?>">
                    <?php if ($review->getImage()): ?>
                        <img class="poster"
                             src="public/uploads/<?php echo htmlspecialchars($review->getImage()); ?>" alt="Review Image">
                    <?php endif; ?>

                    <h1><?php echo htmlspecialchars($review->getTitle()); ?></h1>
                    <?php include 'public/templates/stars.php'; ?>
                    <h3><?php echo htmlspecialchars($review->getReviewTitle()); ?></h3>
                    <p><?php echo htmlspecialchars($review->getDescription()); ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; width: 100%;">You don't have any reviews yet.</p>
    <?php endif; ?>
</div>
</body>
</html>
