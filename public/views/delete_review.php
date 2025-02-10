<?php
session_start();
require_once __DIR__ . "/../repository/ReviewRepository.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reviewID'])) {
    $reviewID = $_POST['reviewID'];
    $userID = $_SESSION['userID'] ?? null;

    $reviewsRepository = new ReviewRepository();
    $review = $reviewsRepository->getReviewById($reviewID);

    if ($review && $review->getUserID() == $userID) {
        if ($reviewsRepository->deleteReview($reviewID)) {
            header("Location: /reviews?message=Review deleted successfully");
            exit();
        } else {
            header("Location: /reviews?error=Failed to delete review");
            exit();
        }
    } else {
        header("Location: /reviews?error=You are not authorized to delete this review");
        exit();
    }
}
?>
