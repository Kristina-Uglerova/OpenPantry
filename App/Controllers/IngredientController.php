<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Ingredient;
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
        if(!Ingredient::deleteIfUnused((int)$id)) {

        }
        return $this->redirect($this->url('Ingredient.index'));
    }
}