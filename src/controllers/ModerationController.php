<?php

require_once "AppController.php";
require_once __DIR__ . '/../repository/UserRepository.php';

class ModerationController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }


    public function moderate()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Sprawdzenie, czy użytkownik jest administratorem
        $userRepo = new UserRepository();
        $user = null;

        if (isset($_SESSION['userID'])) {
            $user = $userRepo->getUserByID($_SESSION['userID']);
        }

        if ($user === null || !$user->getIsAdmin()) {
            header("Location: /login");
            exit();
        }

        $users = $userRepo->getAllUsers();

        // Sprawdzamy, czy kliknięto przycisk zmiany roli
        if (isset($_GET['changeRole'])) {
            $userID = $_GET['changeRole'];
            $userToUpdate = $userRepo->getUserByID($userID);

            if ($userToUpdate) {
                // Zabezpieczamy, aby administrator nie mógł zmienić swojej własnej roli
                if ($userToUpdate->getUserID() == $user->getUserID() && $userToUpdate->getIsAdmin()) {
                    // Jeśli użytkownik próbuje zmienić swoją rolę z admina na zwykłego użytkownika, blokujemy to
                    $_SESSION['error_message'] = 'Nie możesz zmienić swojej roli z administratora na użytkownika.';
                    header("Location: /moderate");
                    exit();
                }

                $wasAdmin = $userToUpdate->getIsAdmin(); // Przechowujemy, czy użytkownik był administratorem
                // Zmieniamy rolę użytkownika
                $userRepo->changeUserRole($userID, $wasAdmin);

                // Po zmianie roli, aktualizujemy sesję, aby odzwierciedlała nową rolę
                if ($userToUpdate->getUserID() == $_SESSION['userID']) {
                    // Jeśli zmieniamy rolę aktualnie zalogowanego użytkownika, odświeżamy sesję
                    $_SESSION['isAdmin'] = $userToUpdate->getIsAdmin();
                }

                // Sprawdzamy, czy użytkownik zmienił rolę na zwykłego użytkownika
                if ($wasAdmin && !$userToUpdate->getIsAdmin()) {
                    // Jeśli był administratorem i teraz nie jest, przekierowujemy do /reviews
                    header("Location: /reviews");
                    exit();
                }
            }
        }

        // Usuwanie użytkownika
        if (isset($_POST['delete'])) {
            $userIDToDelete = $_POST['delete'];
            $userRepo->deleteUser($userIDToDelete);
            header("Location: /moderate");
            exit();
        }

        // Renderowanie widoku
        return $this->render('moderate', ['users' => $users]);
    }

    public function deleteUser($userID)
    {
        if (!isset($_SESSION['userID']) || empty($_SESSION['userID'])) {
            header("Location: /login");
            exit();
        }

        $userRepo = new UserRepository();
        $user = $userRepo->getUserByID($_SESSION['userID']);

        if (!$user || !$user->getIsAdmin()) {
            header("Location: /");
            exit();
        }

        $userRepo->deleteUserByID($userID);
        header("Location: /moderate");
        exit();
    }
}
