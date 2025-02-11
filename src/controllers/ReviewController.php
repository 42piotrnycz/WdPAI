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

        $search = isset($_GET['search']) ? htmlspecialchars(trim($_GET['search'])) : '';
        if (!empty($search) || $search != "") {

            $reviews = $reviewRepository->getUserReviewsByTitle($_SESSION['userID'], $search);
        } else {
            $reviews = $reviewRepository->getUserReviewsByID($_SESSION['userID']);
        }

        return $this->render('reviews', ['reviews' => $reviews, 'search' => $search]);
    }
    public function latestReviews() {
        $reviewRepository = new ReviewRepository();
        $data = $reviewRepository->getLatestUserReviews(30);
        return $this->render('reviews', ['reviews' => $data['reviews'], 'nicknames' => $data['nicknames']]);
    }

    public function addReview()
    {

        if (session_status() == PHP_SESSION_NONE || !isset($_SESSION['userID'])) {
            return $this->render('login');
        }

        if (!$this->isPost())
        {
            return $this->render('add_review', ['messages' => $this->messages]);
        }

        if (isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
        {
            $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            $uniqueFileName = uniqid('review_', true) . '.' . $fileExtension;

            $uploadPath = dirname(__DIR__) . self::UPLOAD_DIRECTORY . $uniqueFileName;

            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath))
            {
                $userID = $_SESSION['userID'] ?? 1;
                $stars = isset($_POST['stars']) ? count($_POST['stars']) : 0;
                $title = $_POST['title'];
                $reviewTitle = $_POST['reviewTitle'];
                $description = $_POST['description'];

                $review = new Review(
                    $userID,
                    $title,
                    $reviewTitle,
                    $description,
                    $stars,
                    $uniqueFileName
                );

                $reviewsRepository = new ReviewRepository();
                $reviewsRepository->saveReview($review);

                $this->messages[] = 'Review added!';
                return $this->render('review', ['messages' => $this->messages, 'review' => $review]);
            }
            else
            {
                $this->messages[] = 'Failed to upload file.';
            }
        }
        else $this->messages[] = 'No file uploaded or file validation failed.';
        return $this->render('add_review', ['messages' => $this->messages]);
    }

    public function showReviews()
    {
        $reviewRepository = new ReviewRepository();
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        $reviews = $reviewRepository->getReviewsByTitle($search);

        return $this->render('reviews', ['reviews' => $reviews]);
    }

    public function getUserReviewsAPI()
    {
        if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $search = isset($_GET['search']) ? $_GET['search'] : '';

            $reviewsRepository = new ReviewRepository();
            $reviews = $reviewsRepository->getUserReviewsByTitle($search);

            $response = [];
            $response['reviews'] = [];

            foreach ($reviews as $review) {
                $response['reviews'][] = [
                    'title' => $review->getTitle(),
                    'image' => $review->getImage(),
                    'stars' => $review->getStars(),
                    'reviewTitle' => $review->getReviewTitle(),
                    'description' => $review->getDescription(),
                    'reviewID' => $review->getReviewID()
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    }

    public function editReviewWorkaround()
    {
        /// IF THE UPDATE IS NOT WORKING, USE THIS WORKAROUND!

        $reviewRepository = new ReviewRepository();
        $reviewRepository->deleteReview($_POST['reviewID']);

        $userID = $_POST['userID'];
        $reviewID = $_POST['reviewID'];
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $reviewTitle = isset($_POST['reviewTitle']) ? $_POST['reviewTitle'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $stars = isset($_POST['stars']) ? count($_POST['stars']) : 0;
        $image = isset($_POST['image']) ? $_POST['image'] : '';

        $review = new Review($userID, $title, $reviewTitle, $description, $stars, $image, $reviewID);

        $reviewRepository->saveReview($review);
        $this->render('review', ['review' => $review]);
        return;

    }
    public function editReview() {
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
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $reviewTitle = isset($_POST['reviewTitle']) ? $_POST['reviewTitle'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $stars = isset($_POST['stars']) ? count($_POST['stars']) : 0;

        $review->setTitle($title);
        $review->setReviewTitle($reviewTitle);
        $review->setDescription($description);
        $review->setStars(($stars));

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
        return;
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
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['reviewID'])) {
            $reviewID = $_POST['reviewID'];
            $reviewRepo = new ReviewRepository();

            if ($reviewRepo->deleteReview($reviewID)) {
                $_SESSION['message'] = "Review deleted successfully!";
            } else {
                $_SESSION['error'] = "Failed to delete the review.";
            }

            header("Location: /reviews");
            exit();
        }
    }




}
