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
        $this->handleSession();

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

        if (isset($_GET['changeRole'])) {
            $userID = $_GET['changeRole'];
            $userToUpdate = $userRepo->getUserByID($userID);

            if ($userToUpdate) {
                if ($userToUpdate->getUserID() == $user->getUserID() && $userToUpdate->getIsAdmin()) {
                    $_SESSION['error_message'] = 'Nie możesz zmienić swojej roli z administratora na użytkownika.';
                    header("Location: /moderate");
                    exit();
                }

                $wasAdmin = $userToUpdate->getIsAdmin();
                $userRepo->changeUserRole($userID, $wasAdmin);

                if ($userToUpdate->getUserID() == $_SESSION['userID']) {
                    $_SESSION['isAdmin'] = $userToUpdate->getIsAdmin();
                }

                if ($wasAdmin && !$userToUpdate->getIsAdmin()) {
                    header("Location: /reviews");
                    exit();
                }
            }
        }

        if (isset($_POST['delete'])) {
            $userIDToDelete = $_POST['delete'];
            $userRepo->deleteUser($userIDToDelete);
            header("Location: /moderate");
            exit();
        }

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
