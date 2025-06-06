<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Ingredient;

class IngredientsApiController extends AControllerBase
{

    public function index(): Response
    {
        throw new HTTPException(501, "Not Implemented");
    }

    public function getIngredients($name = null): Response
    {
        $name = $this->request()->getValue("name");
        $ingredients = Ingredient::getAll("name LIKE :name", ['name' => "%$name%"]);
        return $this->json($ingredients);
    }
}