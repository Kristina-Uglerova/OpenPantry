<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;

class RecipeController extends AControllerBase
{
    public function recipe_detail(): Response
    {
        return $this->html();
    }

    public function recipes(): Response
    {
        return $this->html();
    }

    public function index(): Response
    {
        return $this->html();
    }

    public function recipe_form(): Response
    {
        return $this->html([
            'recipe' => null
        ]);
    }
}