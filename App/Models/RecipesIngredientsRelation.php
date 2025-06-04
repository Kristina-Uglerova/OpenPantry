<?php

class RecipesIngredientsRelation extends \App\Core\Model
{
    protected int $id;
    protected int $recipe_id;
    protected int $ingredient_id;
    protected float $amount;

    public static function containsIngredient(int $ingredientId): bool {
        $results = self::getAll("WHERE ingredient_id = :ingredient_id LIMIT 1", [
            'ingredient_id' => $ingredientId
        ]);
        return !empty($results);
    }
}