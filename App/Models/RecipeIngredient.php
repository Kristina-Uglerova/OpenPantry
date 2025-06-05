<?php
namespace App\Models;
class RecipeIngredient extends \App\Core\Model
{
    protected int $id;
    protected int $recipe_id;
    protected int $ingredient_id;
    protected float $amount;

    public static function containsIngredient(int $ingredientId): bool {
        $results = self::getAll("ingredient_id = :ingredient_id", [
            'ingredient_id' => $ingredientId
        ], null, 1);
        return !empty($results);
    }

    public function setAmount(int $amount) {
        $this->amount = $amount;
    }

    public function setRecipeId(int $recipeId) {
        $this->recipe_id = $recipeId;
    }

    public function setIngredientId(int $ingredientId) {
        $this->ingredient_id = $ingredientId;
    }

    public function getIngredientId() {
        return $this->ingredient_id;
    }
    public function getAmount() {
        return $this->amount;
    }
}