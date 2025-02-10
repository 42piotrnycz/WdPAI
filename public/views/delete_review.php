<?php
session_start();
require_once __DIR__ . "/../repository/ReviewRepository.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reviewID'])) {
    $reviewID = $_POST['reviewID'];
    $userID = $_SESSION['userID'] ?? null;

    $reviewsRepository = new ReviewRepository();
    $review = $reviewsRepository->getReviewById($reviewID);

    // Check if the review exists and if the user owns it
    if ($review && $review->getUserID() == $userID) {
        // Delete the review
        if ($reviewsRepository->deleteReview($reviewID)) {
            // Redirect to the reviews page with a success message
            header("Location: /reviews?message=Review+deleted+successfully");
            exit();
        } else {
            // If deletion fails, redirect with an error
            header("Location: /reviews?error=Failed+to+delete+review");
            exit();
        }
    } else {
        // Unauthorized access or review not found
        header("Location: /reviews?error=You+are+not+authorized+to+delete+this+review");
        exit();
    }
} else {
    // Invalid request
    header("Location: /reviews?error=Invalid+request");
    exit();
}
?>
