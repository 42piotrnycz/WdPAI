<?php

class LogsRepository extends Repository {

    public function getReviewLogsByUserID($userID) {
        $stmt = $this->database->connect()->prepare(
            'SELECT "reviewLogID", "reviewID", "userID", "operationName", "operationDate" 
         FROM "reviews_logs" 
         WHERE "userID" = :userID 
         ORDER BY "operationDate" DESC'
        );
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
