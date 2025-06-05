<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Ingredient;
use App\Models\RecipesIngredientsRelation;
use App\Core\Responses\RedirectResponse;

class IngredientController extends AControllerBase
{
    public function ingredients(): Response
    {
        $ingredients = Ingredient::getAll();
        return $this->html([
            'ingredients' => $ingredients
        ]);
    }
    public function index(): Response
    {
        $ingredients = Ingredient::getAll();
        return $this->html([
            'ingredients' => $ingredients
        ]);
    }

    public function ingredientForm(): Response
    {
        $id = $this->request()->getValue('id');
        $ingredient = Ingredient::getOne($id);

        return $this->html([
            'ingredient' => $ingredient
        ]);
    }

    public function delete(): Response {
        $id = $this->request()->getValue('id');
        $used = RecipesIngredientsRelation::containsIngredient($id);
        if ($used) {
            return false;
        }
        $ingredient = Ingredient::getOne($id);
        $ingredient->delete();
        return $this->redirect($this->url('Ingredient.index'));
    }

    public function update(): Response {
        $id = $this->request()->getValue('id');
        $name = $this->request()->getValue('name');
        $unit = $this->request()->getValue('unit');
        $ingredient = Ingredient::getOne($id);
        $ingredient->setName($name);
        $ingredient->setUnit($unit);
        $ingredient->save();
        return $this->redirect($this->url('Ingredient.index'));
    }

    public function save()
    {
        $id = (int)$this->request()->getValue('id');
        $ingredient = new Ingredient();
        $ingredient->setName($this->request()->getValue('name'));
        $ingredient->setUnit($this->request()->getValue('unit'));
        $ingredient->save();

    }
}