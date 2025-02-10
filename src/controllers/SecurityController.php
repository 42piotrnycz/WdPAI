<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/ReviewRepository.php';

class SecurityController extends AppController
{
    public function register()
    {
        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'];
        $nickname = $_POST['nickname'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $password = $_POST['password'];

        if (empty($email) || empty($nickname) || empty($name) || empty($surname) || empty($password)) {
            header("Location: /register?error=All fields are required");
            exit();
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $user = new User($email, $hashedPassword, $nickname, $name, $surname);

        $userRepository = new UserRepository();
        $userID = $userRepository->addUser($user);

        if ($userID) {
            header("Location: /login?message=Registration successful! Please log in.");
            exit();
        } else {
            header("Location: /register?error=Failed to register. Please try again.");
            exit();
        }
    }
    public function login()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        session_start();

        $userRepository = new UserRepository();
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->getUser($email);

        if (!$user || !password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Invalid email or password!']]);
        }

        $_SESSION['userID'] = $user->getUserId();

        header("Location: /reviews");
        exit();
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