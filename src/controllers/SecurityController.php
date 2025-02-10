<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/ReviewRepository.php';

class SecurityController extends AppController
{
    public function login()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $userRepository = new UserRepository();
        $reviewsRepository = new ReviewRepository();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $_SESSION['userID'] = $user->getUserId();
        $reviews = $reviewsRepository->getUserReviewsByID($user->getUserId());

        header("Location: /reviews");
        exit();
        return $this->render('reviews', ['reviews' => $reviews]);
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: /");
        exit();
    }
}