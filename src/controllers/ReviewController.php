<?php

require_once  'AppController.php';

class ReviewController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/jpg', 'image/jpeg', 'image/png'];
    const UPLOAD_DIRECTORY = '/../public/img/uploads/';

    private $messages = [];

    private function validate(array $file)
    {
        if ($file['size'] > self::MAX_FILE_SIZE)
        {
            $this->messages[] = 'File is too big';
            return false;
        }

        if (!in_array($file['type'], self::SUPPORTED_TYPES))
        {
            $this->messages[] = 'File type is not allowed';
            return false;
        }

        return true;
    }

    public function addReview()
    {
        if ($this->isPost()
        && is_uploaded_file($_FILES['file']['tmp_name'])
        && $this->validate($_FILES['file']))
        {
            move_uploaded_file($_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY . $_FILES['file']['name']);

            $review = new Review($_POST['title'], $_POST['reviewTitle'], $_POST['description'], 10, $_FILES['file']['name']);

            return $this->render('new_review', ['messages' => $this->messages, 'review' => $review]);
        }

        return $this->render('add_review', ['messages' => $this->messages]);
    }

}