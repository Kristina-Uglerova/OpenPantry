<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
class IngredientController extends AControllerBase
{
    public function ingredients(): Response
    {
        return $this->html();
    }

    public function index(): Response
    {
        return $this->html();
    }
}