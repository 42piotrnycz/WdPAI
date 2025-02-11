<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Review</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/review.css">
</head>
<body>

<?php include 'public/templates/navbar.php'; ?>
<?php include 'public/templates/messages.php'; ?>

<div class="base-container">
    <?php if ($review !== null): ?>
        <form class="review-form" action="editReview" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="userID" value="<?= htmlspecialchars($review->getUserID()); ?>">
            <input type="hidden" name="reviewID" value="<?= htmlspecialchars($review->getReviewID()); ?>">
            <input name="title" type="text" placeholder="Title" value="<?= htmlspecialchars($review->getTitle()); ?>">
            <input class="upload-image-button" type="file" name="file"/>
            <input type="hidden" name="image" value="<?= htmlspecialchars($review->getImage()); ?>">

            <img class="poster" src="public/uploads/<?= htmlspecialchars($review->getImage()); ?>"/>

            <?php include 'public/templates/stars.php'; ?>

            <input name="reviewTitle" type="text" placeholder="Review Title" value="<?= htmlspecialchars($review->getReviewTitle()); ?>">
            <textarea name="description" rows="5"><?= htmlspecialchars($review->getDescription()); ?></textarea>

            <button type="submit">Save Changes</button>
        </form>
    <?php else: ?>
        <p>No review found</p>
    <?php endif; ?>
</div>
<script src="public/scripts/stars.js"></script>
</body>
</html>