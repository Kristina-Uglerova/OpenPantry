<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Ingredient;

class IngredientApiController extends AControllerBase
{

    public function index(): Response
    {
        throw new HTTPException(501, "Not Implemented");
    }

    public function getIngredients($name): Response
    {
        $ingredients = Ingredient::getAll("name like %$name%)");
        return $this->json($ingredients);
    }
}