<?php

require_once "Repository.php";
require_once __DIR__ . "/../models/Review.php";

class ReviewsRepository extends Repository
{
    /**
     * Pobiera recenzje użytkownika na podstawie adresu e-mail.
     *
     * @param string $email Adres e-mail użytkownika.
     * @return array Lista obiektów Review.
     */
    public function getUserReviews($email)
    {
        // Zmieniamy 'u.id' na odpowiednią nazwę kolumny w tabeli users
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
                $row['reviewID'],    // zakładamy, że kolumna ma nazwę reviewID
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

}
