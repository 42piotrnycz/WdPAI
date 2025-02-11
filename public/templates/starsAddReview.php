<div class="review-stars">
    <?php for ($i = 1; $i <= 10; $i++): ?>
        <input class="reviewStar" type="checkbox" name="stars[]" value="<?php echo $i; ?>" id="star<?php echo $i; ?>">
        <label for="star<?php echo $i; ?>"></label>
    <?php endfor; ?>
</div>
