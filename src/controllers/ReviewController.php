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

    public function addReview()
    {
        if ($this->isPost()) {
            if (isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
                $uploadPath = dirname(__DIR__) . self::UPLOAD_DIRECTORY . basename($_FILES['file']['name']);

                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
                    $userID = $_SESSION['userID'] ?? 1;

                    $review = new Review(
                        null,
                        $userID,
                        $_POST['title'],
                        $_POST['reviewTitle'],
                        $_POST['description'],
                        10,
                        $_FILES['file']['name']
                    );

                    $reviewsRepository = new ReviewsRepository();
                    $reviewsRepository->saveReview($review);

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
}
