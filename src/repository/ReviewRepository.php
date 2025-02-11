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

    public function getUserReviewsByTitle(int $userID, string $search): array
    {
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM public.reviews 
         WHERE "userID" = :userID AND LOWER("title") LIKE LOWER(:search)'
        );

        $searchTerm = "%$search%";
        $statement->bindParam(':userID', $userID, PDO::PARAM_INT);
        $statement->bindParam(':search', $searchTerm, PDO::PARAM_STR);
        $statement->execute();

        $reviews = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($review) {
            return new Review(
                $review['userID'],
                $review['title'],
                $review['reviewTitle'],
                $review['description'],
                $review['stars'],
                $review['image'],
                $review['reviewID']
            );
        }, $reviews);
    }

    public function getLatestUserReviews($limit = 10) {
        $stmt = $this->database->connect()->prepare(
            "SELECT r.\"reviewID\", r.\"userID\", r.\"title\", r.\"reviewTitle\", r.\"description\", r.\"stars\", r.\"image\"
        FROM reviews r
        ORDER BY r.\"reviewID\" DESC
        LIMIT :limit"
        );

        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Get all the user IDs from the reviews
        $userIDs = array_column($reviews, 'userID');
        $placeholders = str_repeat('?,', count($userIDs) - 1) . '?';

        // Prepare the query to get the nicknames for the user IDs
        $stmt = $this->database->connect()->prepare(
            "SELECT \"userID\", nickname FROM users WHERE \"userID\" IN ($placeholders)"
        );

        $stmt->execute($userIDs);

        // Store user nicknames in an associative array
        $userNicknames = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $userNicknames[$row['userID']] = $row['nickname'];
        }

        // Map the reviews to Review objects
        $reviews = array_map(function ($review) use ($userNicknames) {
            return new Review(
                $review['userID'],
                $review['title'],
                $review['reviewTitle'],
                $review['description'],
                $review['stars'],
                $review['image'],
                $review['reviewID']
            );
        }, $reviews);

        // Return reviews and the corresponding nicknames separately
        return [
            'reviews' => $reviews,
            'nicknames' => $userNicknames
        ];
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

    public function updateReview($review) {
        try {
            $query = 'UPDATE public.reviews SET 
                        title = :title,
                        "reviewTitle" = :reviewTitle,
                        description = :description,
                        stars = :stars,
                        image = :image
                      WHERE "reviewID" = :reviewID';

            $stmt = $this->database->connect()->prepare($query);
            $title = $review->getTitle();
            $reviewTitle = $review->getReviewTitle();
            $description = $review->getDescription();
            $stars = $review->getStars();
            $image = $review->getImage();
            $reviewID = $review->getReviewID();

            $stmt->bindParam(':reviewID', $reviewID);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':reviewTitle', $reviewTitle);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':stars', $stars, PDO::PARAM_INT);
            $stmt->bindParam(':image', $image, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            // Obsługuje błąd
            return false;
        }
    }


    public function deleteReview($reviewID)
    {
        $stmt = $this->database->connect()->prepare('SELECT image FROM reviews WHERE "reviewID" = :reviewID');
        $stmt->bindParam(':reviewID', $reviewID, PDO::PARAM_INT);
        $stmt->execute();
        $image = $stmt->fetchColumn();

        $query = 'DELETE FROM reviews WHERE "reviewID" = :reviewID';
        $stmt = $this->database->connect()->prepare($query);
        $stmt->bindParam(':reviewID', $reviewID, PDO::PARAM_INT);

        if ($stmt->execute()) {
            if ($image && file_exists("public/uploads/$image")) {
                unlink("public/uploads/$image"); // Delete image file
            }
            return true;
        }

        return false;
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

    public function updateReviewImage(int $reviewID, string $newImageName): bool
    {
        $statement = $this->database->connect()->prepare(
            'UPDATE public.reviews SET image = :image WHERE "reviewID" = :reviewID'
        );
        $statement->bindParam(':image', $newImageName, PDO::PARAM_STR);
        $statement->bindParam(':reviewID', $reviewID, PDO::PARAM_INT);

        return $statement->execute();
    }
}
