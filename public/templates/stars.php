<head>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<?php if ($review != NULL): ?>
    <div class="review-stars">
        <?php
        $stars = $review->getStars();
        for ($i = 1; $i <= 10; $i++):
            // Create a unique ID for each star for accessibility
            $starId = "reviewStar" . $i;
            ?>
            <input
                    class="reviewStar"
                    type="checkbox"
                    id="<?= $starId; ?>"
                    name="stars[]"
                    value="<?= $i; ?>"
                <?= $i <= $stars ? 'checked' : ''; ?>
            >
            <label for="<?= $starId; ?>"></label>
        <?php endfor; ?>
    </div>
<?php endif; ?>
