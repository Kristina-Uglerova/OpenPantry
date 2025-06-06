<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Core\Responses\ViewResponse;
use App\Models\User;

/**
 * Class AuthController
 * Controller for authentication actions
 * @package App\Controllers
 */
class AuthController extends AControllerBase
{
    /**
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->redirect(Configuration::LOGIN_URL);
    }

    /**
     * Login a user
     * @return Response
     */
    public function login(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        $logged = $this->app->getAuth()->login($formData['login'], $formData['password']);
        if ($logged) {
            return $this->redirect($this->url("home.index"));
        }
        $data = ($logged === false ? ['message' => 'Incorrect login or password!'] : []);
        return $this->redirect($this->url("home.index", [$data['message']]));
    }

    /**
     * Logout a user
     * @return ViewResponse
     */
    public function logout(): Response
    {
        $this->app->getAuth()->logout();
        return $this->redirect($this->url('home.index'));
    }

    public function register(): Response
    {
        $email = $this->request()->getValue('email');
        $password = $this->request()->getValue('password');
        $confirmPassword = $this->request()->getValue('confirm_password');
        $error = '';
        if(trim($email) === "" || trim($password) === "" || trim($confirmPassword) === "") {
            $error = 'All fields are required';
        }

        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email format.';
        }

        if ($password !== $confirmPassword) {
            $error = 'Passwords do not match.';
        }

        if ($email && User::getUserByEmail($email)) {
            $error = 'This email is already registered.';
        }

        if (!empty($error)) {
            $data = ['message' => $error];
            return $this->redirect($this->url("home.index", [$data['message']]));
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $user = new User();
        $user->setEmail($email);
        $user->setPasswordHashed($hashedPassword);
        $user->setIsAdmin(false);

        $user->save();

        return $this->redirect("?c=home");
    }
}