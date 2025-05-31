<?php

class RecipesIngredientsRelation extends \App\Core\Model
{
    protected int $id;
    protected int $recipe_id;
    protected int $ingredient_id;
    protected float $amount;
}