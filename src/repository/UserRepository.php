<?php

require_once "Repository.php";
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUserByID(int $userID): ?User
    {
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM public.users WHERE "userID" = :userID'  /* Ensure correct casing */
        );
        $statement->bindParam(':userID', $userID, PDO::PARAM_INT);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['nickname'],
            $user['name'],
            $user['surname'],
            $user['userID']
        );
    }

    public function getUser(string $email) : ?User
    {
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM public.users WHERE email = :email'
        );
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null; //throw new Exception("User wtih email '$email' not found in the database.");
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['nickname'],
            $user['name'],
            $user['surname'],
            $user['userID']
        );
    }

    public function addUser(User $user): bool
    {
        $statement = $this->database->connect()->prepare(
            'INSERT INTO public.users (email, password, nickname, name, surname) VALUES (:email, :password, :nickname, :name, :surname)'
        );

        $email = $user->getEmail();
        $password = $user->getPassword();
        $nickname = $user->getNickname();
        $name = $user->getName();
        $surname = $user->getSurname();

        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->bindParam(':nickname', $nickname, PDO::PARAM_STR);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':surname', $surname, PDO::PARAM_STR);

        if ($statement->execute()) {
            return true;
        } else {
            // error_log('Database error: ' . implode(' ', $statement->errorInfo()));
            return false;
        }
    }
}