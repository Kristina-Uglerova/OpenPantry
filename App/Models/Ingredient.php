<?php
namespace App\Models;

use App\Core\Model;
use App\Core\DB\Connection;
class Ingredient extends \App\Core\Model
{
    protected int $id;
    protected string $name;
    protected string $unit;

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getUnit(): string { return $this->unit; }
    public function deleteIfUnused(int $ingredientId): bool {
        $used = \RecipesIngredientsRelation::containsIngredient($ingredientId);
        if ($used) {
            return false;
        }
        self::delete();
        return true;
    }
}