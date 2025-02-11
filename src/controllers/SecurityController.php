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
            $messages[] = 'All fields are required';
        }

        $userRepository = new UserRepository();

        if ($userRepository->emailExists($email)) {
            $messages[] = 'Email is already in use';
        }

        if ($userRepository->nicknameExists($nickname)) {
            $messages[] = 'Nickname is already taken';
        }

        if (!empty($messages)) {
            return $this->render('register', ['messages' => $messages]);
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

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userRepository = new UserRepository();
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->getUser($email);

        if (!$user || !password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Invalid email or password!']]);
        }

        $_SESSION['userID'] = $user->getUserId();
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));



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