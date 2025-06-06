<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Ingredient;
use App\Models\RecipeIngredient;
use App\Core\Responses\RedirectResponse;
use mysql_xdevapi\Exception;

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
        $used = RecipeIngredient::containsIngredient($id);
        if ($used) {
            return $this->redirect($this->url('Ingredient.index'));
        }
        $ingredient = Ingredient::getOne($id);
        $ingredient->delete();
        return $this->redirect($this->url('Ingredient.index'));
    }

    public function update(): Response {
        $id = $this->request()->getValue('id');
        $name = $this->request()->getValue('name');
        $unit = $this->request()->getValue('unit');
        try {
            $ingredient = Ingredient::getOne($id);
        } catch (Exception) {
            $data = ['message' => 'Ingredient was not found'];
            return $this->redirect($this->url("home.index", [$data['message']]));
        }
        if (trim($name) === '' || trim($unit) === '') {
            $data = ['message' => 'Al items has to be filled'];
            return $this->redirect($this->url("home.index", [$data['message']]));
        }
        $ingredient->setName($name);
        $ingredient->setUnit($unit);
        $ingredient->save();
        return $this->redirect($this->url('Ingredient.index'));
    }

    public function save()
    {
        $id = (int)$this->request()->getValue('id');
        $ingredient = new Ingredient();
        $name = $this->request()->getValue('name');
        $unit = $this->request()->getValue('unit');
        if (trim($name) === '' || trim($unit) === '') {
            $data = ['message' => 'All items has to be filled'];
            return $this->redirect($this->url("recipe.form", [$data['message']]));
        }
        $ingredient->setName($name);
        $ingredient->setUnit($unit);
        $ingredient->save();
    }
}