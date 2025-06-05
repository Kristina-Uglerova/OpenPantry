<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;
use App\Models\Ingredient;
use App\Models\Recipe;

class RecipeController extends AControllerBase
{
    public function recipe_detail(): Response
    {
        $id = $this->request()->getValue('recipeId');
        $recipe = Recipe::getOne($id);
        return $this->html([
            'recipe' => $recipe
        ]);
    }

    public function recipes(): Response
    {
        $recipes = Recipe::getAll();
        return $this->html([
            'recipes' => $recipes
        ]);
    }

    public function users_recipes(): Response
    {
        $recipes = Recipe::getAll("user_id = " . $_SESSION["user"]);
        return $this->html([
            'recipes' => $recipes
        ]);    }

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

    public function save()
    {
        $id = (int)$this->request()->getValue('id');
        $recipe = new Recipe();
        $recipe->setName($this->request()->getValue('title'));
        $recipe->setImagePath($this->request()->getFiles()['image']['name']);
        $recipe->setDescription($this->request()->getValue('description'));
        $recipe->setUserId((int)$this->app->getAuth()->getLoggedUserId());
        $newFileName = FileStorage::saveFile($this->request()->getFiles()['image']);
        $recipe->setImagePath($newFileName);
        $recipe->save();
        return $this->redirect($this->url("recipe.recipe_detail", ["id" => $id]));
    }

    public function delete() {
        $id = (int)$this->request()->getValue('id');
        $recipe = Recipe::getOne($id);
        $recipe->delete();
        return $this->redirect($this->url("recipe.users_recipes"));
    }
}