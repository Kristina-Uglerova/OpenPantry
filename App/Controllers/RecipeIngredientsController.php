<?php

namespace App\Controllers;

use App\Models\RecipeIngredient;

class RecipeIngredientsController extends IAControllerBase
{
    public function index(): Response
    {
        $ingredients = Ingredient::getAll();
        return $this->html();
    }

    public function save()
    {
        $id = (int)$this->request()->getValue('id');
        $recipeIngredient = new RecipeIngredient();
        $recipeIngredient->setName($this->request()->getValue('name'));
        $recipeIngredient->setUnit($this->request()->getValue('unit'));
        $recipeIngredient->save();
    }
}