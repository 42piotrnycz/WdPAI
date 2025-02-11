<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/reviews.css">
    <link rel="stylesheet" type="text/css" href="public/css/add_review.css">

    <title>Adding new review...</title>
</head>

<body>
    <?php include 'public/templates/navbar.php'; ?>

    <div class="base-container">
        <form class="review-form" action="addReview" method="POST" enctype="multipart/form-data">
            <?php include 'public/templates/messages.php'; ?>

            <input name="title" type="text" placeholder="Title">
            <input class="upload-image-button" type="file" name="file" id="fileInput" onchange="updateImagePreview(this)"/><br/>
            <img class="poster" id="imagePreview" src="public/img/empty_image_field.png" alt="Image Preview" />

            <?php include 'public/templates/starsAddReview.php'; ?>

            <input name="reviewTitle" type="text" placeholder="Review Title">
            <textarea name="description" rows="16" placeholder="Your review goes here..."></textarea>
            <button type="submit">ADD</button>

        </form>
    </div>

    <script src="public/scripts/updateImagePreview.js"></script>
    <script src="public/scripts/stars.js"></script>
</body>
