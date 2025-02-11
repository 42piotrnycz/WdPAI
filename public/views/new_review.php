<!DOCTYPE html>

<head>
    <title>Adding new Review...</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/reviews.css">

</head>

<body>
    <div class="base-container">
        <div class="reviews-container">
            <?php if ($review !== null): ?>
                <h3 class="movie-title"><?= htmlspecialchars($review->getTitle()) ?></h3>
                <img class="poster" style="display:block"
                     src="public/uploads/<?= htmlspecialchars($review->getImage()) ?>"
                     alt="Movie Poster">
                <h4 class="review-title"><?= htmlspecialchars($review->getReviewTitle()) ?></h4>
                <p class="review-description"><?= nl2br(htmlspecialchars($review->getDescription())) ?></p>
            <?php else: ?>
                <p>No review available</p>
            <?php endif; ?>
        </div>
    </div>
</body>