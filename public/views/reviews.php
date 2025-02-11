<!DOCTYPE html>
<html>
<head>
    <title>Viewing Reviews...</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/reviews.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php include 'public/templates/navbar.php'; ?>

<div class="reviews-filters"><?php include 'public/templates/starChart.php'; ?></div>

<?php if (!isset($nicknames)): ?>
<div class="reviews-filters">
    <form method="GET" action="reviews">
        <input type="text" name="search" placeholder="Movie/book/game title..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit">Search</button>
    </form>
</div>
<?php endif; ?>

<div class="reviews-grid">
    <?php if (isset($reviews) && count($reviews) > 0): ?>
        <?php foreach ($reviews as $review): ?>
            <div class="review-container">
                <?php if (isset($nicknames)): ?>
                    <h3><?php echo $nicknames[$review->getUserID()]; ?></h3>
                <?php endif; ?>
                <a href="review?id=<?php echo urlencode($review->getReviewID()); ?>">
                    <?php if ($review->getImage()): ?>
                        <img class="poster"
                             src="public/uploads/<?php echo htmlspecialchars($review->getImage()); ?>" alt="Review Image">
                    <?php endif; ?>

                    <h1><?php echo htmlspecialchars($review->getTitle()); ?></h1>
                    <?php include 'public/templates/stars.php'; ?>
                    <h3><?php echo htmlspecialchars($review->getReviewTitle()); ?></h3>
                    <p class="review-description"><?php echo htmlspecialchars($review->getDescription()); ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; width: 100%;">You don't have any reviews yet.</p>
    <?php endif; ?>
</div>
</body>
</html>
