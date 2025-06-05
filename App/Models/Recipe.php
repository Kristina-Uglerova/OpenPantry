<?php
namespace App\Models;

use App\Core\Model;

class Recipe extends Model
{
    protected int $id;
    protected string $name;
    protected string $description;
    protected string $image_path;
    protected int $user_id;

    public function getImagePath(): string {
        return $this->image_path;
    }
    public function getId(): int {
        return $this->id;
    }
    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setImagePath(string $image_path): void {
        $this->image_path = $image_path;
    }

    public function setUserId(int $user_id): void {
        $this->user_id = $user_id;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}