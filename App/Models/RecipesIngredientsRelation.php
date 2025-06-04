<?php
namespace App\Models;
class RecipesIngredientsRelation extends \App\Core\Model
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
}