<?php

class User extends \App\Core\Model
{
    protected int $id;
    protected  string $email;
    protected string $password_hashed;
    protected bool $is_admin;
}