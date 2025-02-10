<!DOCTYPE html>

<head>
    <title>Add new review</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/reviews.css">



    <title>REVIEWS</title>
</head>

<body>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    } ?>
    <div class="base-container">
        <div class="review-upload-container">
            <form class="review-form" action="addReview" method="POST" enctype="multipart/form-data">

                <input name="title" type="text" placeholder="Title">
                <input class="upload-image-button" type="file" name="file" id="fileInput" onchange="updateImagePreview(this)"/><br/>
                <img class="poster" id="imagePreview" src="public/img/empty_image_field.png" alt="Image Preview" />

                <div class="review-stars">
                    <input class="reviewStar" type="checkbox" name="stars[]" value="1" id="star1"><label for="star1"></label>
                    <input class="reviewStar" type="checkbox" name="stars[]" value="2" id="star2"><label for="star2"></label>
                    <input class="reviewStar" type="checkbox" name="stars[]" value="3" id="star3"><label for="star3"></label>
                    <input class="reviewStar" type="checkbox" name="stars[]" value="4" id="star4"><label for="star4"></label>
                    <input class="reviewStar" type="checkbox" name="stars[]" value="5" id="star5"><label for="star5"></label>
                    <input class="reviewStar" type="checkbox" name="stars[]" value="6" id="star6"><label for="star6"></label>
                    <input class="reviewStar" type="checkbox" name="stars[]" value="7" id="star7"><label for="star7"></label>
                    <input class="reviewStar" type="checkbox" name="stars[]" value="8" id="star8"><label for="star8"></label>
                    <input class="reviewStar" type="checkbox" name="stars[]" value="9" id="star9"><label for="star9"></label>
                    <input class="reviewStar" type="checkbox" name="stars[]" value="10" id="star10"><label for="star10"></label>
                </div>


                <input name="reviewTitle" type="text" placeholder="Review Title">
                <textarea name="description" rows="5" placeholder="Your review goes here..."></textarea>
                <button type="submit">send</button>

                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>

    <script src="public/scripts/updateImagePreview.js"></script>
    <script src="public/scripts/stars.js"></script>
</body>
