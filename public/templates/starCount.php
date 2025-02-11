<?php
$starCount = array_fill(0, 11, 0);

foreach ($reviews as $review) {
    $stars = $review->getStars();
    if ($stars >= 0 && $stars <= 10) {
        $starCount[$stars]++;
    }
}
?>

<script>
    const starCount = <?php echo json_encode($starCount); ?>;
</script>
