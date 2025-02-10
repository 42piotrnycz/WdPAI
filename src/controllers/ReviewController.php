<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Review.php';
require_once __DIR__ . '/../repository/ReviewRepository.php';

class ReviewController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/jpg', 'image/jpeg', 'image/png'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];

    private function validate(array $file)
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too big. Max size is 1MB';
            return false;
        }

        if (!in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type is not allowed. Only JPG, JPEG, PNG are accepted';
            return false;
        }

        return true;
    }


    public function review()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            die('Wrong URL! Recenzja nie została znaleziona.');
        }

        $reviewID = intval($_GET['id']);
        $reviewRepository = new ReviewRepository();
        $review = $reviewRepository->getReviewById($reviewID);

        if (!$review) {
            die('Wrong URL! Recenzja nie istnieje.');
        }

        return $this->render('review', ['review' => $review]);
    }


    public function reviews()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['userID'])) {
            header("Location: /login");
            exit();
        }

        $reviewRepository = new ReviewRepository();
        $reviews = $reviewRepository->getUserReviewsByID($_SESSION['userID']);

        return $this->render('reviews', ['reviews' => $reviews]);
    }


    public function addReview()
    {
        if ($this->isPost()) {
            if (isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
                $uploadPath = dirname(__DIR__) . self::UPLOAD_DIRECTORY . basename($_FILES['file']['name']);

                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
                    $userID = $_SESSION['userID'] ?? 1;

                    $stars = isset($_POST['stars']) ? count($_POST['stars']) : 0;

                    $review = new Review(
                        $userID,
                        $_POST['title'],
                        $_POST['reviewTitle'],
                        $_POST['description'],
                        $stars,
                        $_FILES['file']['name']
                    );

                    $reviewsRepository = new ReviewRepository();
                    $reviewsRepository->saveReview($review);

                    $this->messages[] = 'Review added!';
                    return $this->render('review', ['messages' => $this->messages, 'review' => $review]);
                } else {
                    $this->messages[] = 'Failed to upload file.';
                }
            } else {
                $this->messages[] = 'No file uploaded or file validation failed.';
            }
        }

        return $this->render('add_review', ['messages' => $this->messages]);
    }

    public function editReview()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['reviewID'])) {
            header("Location: /reviews?error=Invalid request");
            exit();
        }

        $reviewID = $_POST['reviewID'];
        $userID = $_SESSION['userID'] ?? null;

        if (!$userID) {
            header("Location: /reviews?error=Unauthorized access");
            exit();
        }

        $reviewsRepository = new ReviewRepository();
        $review = $reviewsRepository->getReviewById($reviewID);

        if (!$review || $review->getUserID() != $userID) {
            header("Location: /reviews?error=You are not authorized to edit this review");
            exit();
        }
        $stars = isset($_POST['stars']) ? count($_POST['stars']) : 0;

        $review->setTitle($_POST['title']);
        $review->setReviewTitle($_POST['reviewTitle']);
        $review->setDescription($_POST['description']);
        $review->setStars(($stars));

        // Handle new image upload
        if (!empty($_FILES['file']['name'])) {
            $uploadPath = dirname(__DIR__) . self::UPLOAD_DIRECTORY . basename($_FILES['file']['name']);
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
                $review->setImage($_FILES['file']['name']);
            }
        }

        if ($reviewsRepository->editReview($review)) {
            header("Location: /review?id=$reviewID&message=Review updated successfully");
            exit();
        } else {
            header("Location: /edit_review?id=$reviewID&error=Failed to update review");
            exit();
        }
    }

    public function editReviewPage()
    {
        if (!isset($_GET['id'])) {
            header("Location: /reviews?error=Invalid request");
            exit();
        }

        $reviewID = $_GET['id'];
        $userID = $_SESSION['userID'] ?? null;

        if (!$userID) {
            header("Location: /reviews?error=Unauthorized access");
            exit();
        }

        $reviewsRepository = new ReviewRepository();
        $review = $reviewsRepository->getReviewById($reviewID);

        if (!$review || $review->getUserID() != $userID) {
            header("Location: /reviews?error=You are not authorized to edit this review");
            exit();
        }

        return $this->render('edit_review', ['review' => $review]);
    }

    public function deleteReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reviewID'])) {
            $reviewID = $_POST['reviewID'];
            $userID = $_SESSION['userID'] ?? null;

            $reviewsRepository = new ReviewRepository();
            $review = $reviewsRepository->getReviewById($reviewID);

            // Check if review exists and user is the owner
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
        } else {
            header("Location: /reviews?error=Invalid request");
            exit();
        }
    }


}
