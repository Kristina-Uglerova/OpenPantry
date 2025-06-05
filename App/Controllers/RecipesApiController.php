<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Recipe;

class RecipesApiController extends AControllerBase
{

    public function index(): Response
    {
        throw new HTTPException(501, "Not Implemented");
    }

    public function getRecipes($name = null): Response
    {
        $name = $this->request()->getValue("name");
        $recipes = Recipe::getAll("name LIKE '%" . $name . "%'");
        return $this->json($recipes);
    }
}