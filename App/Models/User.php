<?php

namespace App\Models;

use App\Core\Model;
use App\Core\DB\Connection;

class User extends Model
{
    private static ?Connection $connection = null;

    protected int $id;
    protected string $email;
    protected string $password_hashed;
    protected bool $is_admin;

    public function setPasswordHashed(string $password): void
    {
        $this->password_hashed = $password;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setIsAdmin(bool $isAdmin): void
    {
        $this->is_admin = $isAdmin;
    }

    public function isAdmin(): bool {
        return $this->is_admin;
    }
    public static function getUserByEmail(string $email): ?User {
        $usersWithEmail = self::getAll("email = :email", ["email" => $email]);
        if (count($usersWithEmail) > 0) {
            return $usersWithEmail[0];
        } else {
            return null;
        }
    }
    public function getPasswordHashed(): string
    {
        return $this->password_hashed;
    }
}