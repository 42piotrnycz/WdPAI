<?php
session_start();

require_once "Repository.php";
require_once __DIR__ . "/../models/Review.php";
require_once __DIR__ . "/../repository/ReviewRepository.php";

class ReviewRepository extends Repository
{
    public function getReviewById($reviewID)
    {
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM public.reviews WHERE "reviewID" = :reviewID'
        );
        $statement->bindParam(':reviewID', $reviewID, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        return new Review(
            $row['userID'],
            $row['title'],
            $row['reviewTitle'],
            $row['description'],
            $row['stars'],
            $row['image'],
            $row['reviewID']
        );
    }

    public function getUserReviews($email)
    {
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM public.reviews WHERE "userID" = (
            SELECT "userID" FROM public.users WHERE email = :email
        )'
        );
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $reviews = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $reviews[] = new Review(
                $row['userID'],
                $row['title'],
                $row['reviewTitle'],
                $row['description'],
                $row['stars'],
                $row['image'],
                $row['reviewID']
            );
        }

        return $reviews;
    }

    public function getUserReviewsByID($userID)
    {
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM public.reviews WHERE "userID" = :userID'
        );
        $statement->bindParam(':userID', $userID, PDO::PARAM_INT);
        $statement->execute();

        $reviews = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $reviews[] = new Review(
                $row['userID'],
                $row['title'],
                $row['reviewTitle'],
                $row['description'],
                $row['stars'],
                $row['image'],
                $row['reviewID']
            );
        }

        return $reviews;
    }


    public function saveReview(Review $review)
    {
        $statement = $this->database->connect()->prepare(
            'INSERT INTO public.reviews ("userID", "reviewTitle", "title", "description", stars, image) 
         VALUES (:userID, :reviewTitle, :title, :description, :stars, :image)
         RETURNING "reviewID"'
        );

        $userID = $review->getUserID() ?? $_SESSION['userID'];
        $title = $review->getTitle();
        $reviewTitle = $review->getReviewTitle();
        $description = $review->getDescription();
        $stars = (int)$review->getStars();
        $image = $review->getImage();

        if ($userID === null) {
            echo "User ID is required!";
            return;
        }

        $statement->bindParam(':userID', $userID, PDO::PARAM_INT);
        $statement->bindParam(':reviewTitle', $reviewTitle, PDO::PARAM_STR);
        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':stars', $stars, PDO::PARAM_INT);
        $statement->bindParam(':image', $image, PDO::PARAM_STR);

        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $reviewID = $row['reviewID'];

        $review->setReviewID($reviewID);

        return $review;
    }

    public function editReview(Review $review)
    {
        $statement = $this->database->connect()->prepare(
            'UPDATE public.reviews 
        SET "title" = :title, "reviewTitle" = :reviewTitle, "description" = :description, "stars" = :stars, "image" = :image
        WHERE "reviewID" = :reviewID AND "userID" = :userID'
        );

        $title = $review->getTitle();
        $reviewTitle = $review->getReviewTitle();
        $description = $review->getDescription();
        $stars = $review->getStars();
        $image = $review->getImage();
        $reviewID = $review->getReviewID();
        $userID = $review->getUserID();

        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        $statement->bindParam(':reviewTitle', $reviewTitle, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':stars', $stars, PDO::PARAM_INT);
        $statement->bindParam(':image', $image, PDO::PARAM_STR);
        $statement->bindParam(':reviewID', $reviewID, PDO::PARAM_INT);
        $statement->bindParam(':userID', $userID, PDO::PARAM_INT);


        return $statement->execute();
    }

    public function deleteReview(int $reviewID): bool
    {
        $statement = $this->database->connect()->prepare(
            'DELETE FROM public.reviews WHERE "reviewID" = :reviewID'
        );
        $statement->bindParam(':reviewID', $reviewID, PDO::PARAM_INT);

        return $statement->execute();
    }

}
