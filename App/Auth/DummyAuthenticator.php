<?php

namespace App\Auth;

use App\Core\IAuthenticator;
use App\Models\User;

/**
 * Class DummyAuthenticator
 * Basic implementation of user authentication
 * @package App\Auth
 */
class DummyAuthenticator implements IAuthenticator
{
    private string $login;
    private string $hashedPassword;
    private string $isLogged;
    /**
     * DummyAuthenticator constructor
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * Verify, if the user is in DB and has his password is correct
     * @param $login
     * @param $password
     * @return bool
     * @throws \Exception
     */
    public function login($login, $password): bool
    {
        $user = User::getUserByEmail($login);
        if($user != null) {
            $isPasswordValid = password_verify($password, $user->getPasswordHashed());
            if($isPasswordValid) {
                $_SESSION['user'] = $login;
                return true;
            }
        }
        return false;
    }

    /**
     * Logout the user
     */
    public function logout(): void
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            session_destroy();
        }
    }

    /**
     * Get the name of the logged-in user
     * @return string
     * @throws \Exception
     */
    public function getLoggedUserName(): string
    {
        return isset($_SESSION['user']) ? $_SESSION['user'] : throw new \Exception("User not logged in");
    }

    /**
     * Get the context of the logged-in user
     * @return string
     */
    public function getLoggedUserContext(): mixed
    {
        return null;
    }

    /**
     * Return if the user is authenticated or not
     * @return bool
     */
    public function isLogged(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user'] != null;
    }

    public function isUserAdmin(): bool {
        if (!$this->isLogged()) {
            return false;
        }

        $user = User::getUserByEmail($_SESSION['user']);
        if (!$user) {
            return false;
        }

        return $user->isAdmin();
    }


    /**
     * Return the id of the logged-in user
     * @return mixed
     */
    public function getLoggedUserId(): mixed
    {
        return $_SESSION['user'];
    }
}