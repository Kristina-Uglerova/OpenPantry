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
        return $this->html([
            'ingredients' => Ingredient::getAll()
        ]);
    }
}