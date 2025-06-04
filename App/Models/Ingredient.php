<?php
namespace App\Models;

use App\Core\Model;
class Ingredient extends Model
{
    protected int $id;
    protected string $name;
    protected string $unit;

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getUnit(): string { return $this->unit; }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }
}