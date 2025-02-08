<!DOCTYPE html>
<html>
<head>
    <title>User Reviews</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/reviews.css">
    <link rel="stylesheet" href="public/css/navbar.css">

</head>

<nav class="navbar">
    <a href="index.php" class="navbar-logo">My Reviews</a>
    <div class="navbar-links">
        <a href="/index"><button type="button">Main Page</button></a>
        <a href="/add_review"><button type="button" action="addReview">Add Review</button></a>
        <button type="submit" action="reviews">All Reviews</button>
    </div>
</nav>
<body>
<div class="reviews-grid">
    <?php if (isset($reviews) && count($reviews) > 0): ?>
        <?php foreach ($reviews as $review): ?>
            <div class="review-container">

                <?php if ($review->getImage()): ?>
                    <img class="poster"
                         src="public/uploads/<?php echo htmlspecialchars($review->getImage()); ?>" alt="Review Image">
                <?php endif; ?>

                <div class="review-stars">
                    <?php
                    $stars = $review->getStars();
                    for ($i = 1; $i <= 10; $i++):
                        ?>
                        <input class="reviewStar" type="checkbox" id="star-view-<?php echo $review->getReviewID() . '-' . $i; ?>" disabled <?php echo $i <= $stars ? 'checked' : ''; ?>>
                        <label for="star-view-<?php echo $review->getReviewID() . '-' . $i; ?>"></label>
                    <?php endfor; ?>
                </div>


                <h2> <?php echo htmlspecialchars($review->getTitle()); ?></h2>
                <h3><?php echo htmlspecialchars($review->getReviewTitle()); ?></h3>
                <p> <?php echo htmlspecialchars($review->getDescription()); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; width: 100%;">You don't have any reviews yet.</p>
    <?php endif; ?>
</div>
</body>
</html>