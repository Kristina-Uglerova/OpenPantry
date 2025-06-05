<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Helpers\FileStorage;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeIngredient;

class RecipeController extends AControllerBase
{
    public function recipe_detail(): Response
    {
        $id = $this->request()->getValue('recipeId');
        $recipe = Recipe::getOne($id);
        return $this->html([
            'recipe' => $recipe,
            'ingredients' => $this->fetchRecipeIngredientsInfo($id)
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
        $id = $this->request()->getValue('recipeId');
        $recipe = null;

        if ($id) {
            $recipe = Recipe::getOne($id);
        }

        return $this->html([
            'recipe' => $recipe
        ]);
    }

    public function save()
    {
        $id = (int)$this->request()->getValue('id');
        $recipe = $id ? Recipe::getOne($id) : new Recipe();
        $recipe->setName($this->request()->getValue('title'));
        $recipe->setDescription($this->request()->getValue('description'));
        $recipe->setUserId((int)$this->app->getAuth()->getLoggedUserId());

        if (!empty($this->request()->getFiles()['image']['name'])) {
            $newFileName = FileStorage::saveFile($this->request()->getFiles()['image']);
            $recipe->setImagePath($newFileName);
        }

        $recipe->save();

        if (!$id) {
            $ingredients = $this->request()->getValue('ingredients');
            if (is_array($ingredients)) {
                $this->createRecipeIngredients($ingredients, $recipe->getId());
            }
        }

        return $this->redirect($this->url("recipe.users_recipes"));
    }

    public function createRecipeIngredients(array $ingredients, int $recipeId) {
        foreach ($ingredients as $ingredient) {
            $recipeIngredient = new RecipeIngredient();
            $recipeIngredient->setRecipeId($recipeId);
            $recipeIngredient->setIngredientId($ingredient['id']);
            $recipeIngredient->setAmount($ingredient['amount']);
            $recipeIngredient->save();
        }
    }

    public function delete() {
        $id = (int)$this->request()->getValue('id');
        $recipe = Recipe::getOne($id);
        FileStorage::deleteFile($recipe->getImagePath());
        $recipe->delete();
        return $this->redirect($this->url("recipe.users_recipes"));
    }

    public function fetchRecipeIngredientsInfo(int $recipeId): array
    {
        $result = [];
        $recipeIngredients = RecipeIngredient::getAll('recipe_id = '. $recipeId);

        foreach ($recipeIngredients as $recipeIngredient) {
            $ingredient = Ingredient::getOne($recipeIngredient->getIngredientId());

            if ($ingredient) {
                $result[] = [
                    'name' => $ingredient->getName(),
                    'unit' => $ingredient->getUnit(),
                    'amount' => $recipeIngredient->getAmount()
                ];
            }
        }

        return $result;
    }

}