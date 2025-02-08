<?php
session_start();

require_once "Repository.php";
require_once __DIR__ . "/../models/Review.php";

class ReviewsRepository extends Repository
{
    public function getUserReviews($email)
    {
        $statement = $this->database->connect()->prepare(
            'SELECT r.* FROM public.reviews r
         WHERE r."userID" = (
             SELECT u."userID" FROM public.users u WHERE u.email = :email
         )'
        );
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $reviews = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $reviews[] = new Review(
                $row['reviewID'],
                $row['userID'],
                $row['title'],
                $row['reviewTitle'],
                $row['description'],
                $row['stars'],
                $row['image']
            );
        }

        return $reviews;
    }

    public function saveReview(Review $review)
    {
        $statement = $this->database->connect()->prepare(
            'INSERT INTO public.reviews ("userID", "reviewTitle", "title", "description", stars, image) 
         VALUES (:userID, :reviewTitle, :title, :description, :stars, :image)'
        );

        // Fetch userID from session or from the review object
        $userID = $review->getUserID() ?? $_SESSION['userID'];  // Check if it's passed, else get from session
        $title = $review->getTitle();
        $reviewTitle = $review->getReviewTitle();
        $description = $review->getDescription();
        $stars = (int)$review->getStars();  // Ensure this is an integer, cast to int
        $image = $review->getImage();

        // Check if userID is not null
        if ($userID === null) {
            // Handle the case where userID is null, e.g., redirect to login
            echo "User ID is required!";
            return;
        }

        // Bind parameters to the prepared statement
        $statement->bindParam(':userID', $userID, PDO::PARAM_INT);
        $statement->bindParam(':reviewTitle', $reviewTitle, PDO::PARAM_STR);
        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':stars', $stars, PDO::PARAM_INT);
        $statement->bindParam(':image', $image, PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();
    }





}
