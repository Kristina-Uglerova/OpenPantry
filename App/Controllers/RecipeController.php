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
        $recipes = Recipe::getAll("user_id = :user_id", ['user_id' => $_SESSION['user']]);
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
        $title = trim($this->request()->getValue('title'));
        $description = trim($this->request()->getValue('description'));

        if ($title === '' || $description === '') {
            $data = ['message' => 'Title and description must be filled in.'];
            return $this->redirect($this->url("recipe.recipe_form", [$data['message']]));
        }
        $userId = (int)$this->app->getAuth()->getLoggedUserId();
        if ($userId <= 0) {
            return $this->redirect($this->url("home.index", ['You must be logged in.']));
        }
        $recipe->setName($title);
        $recipe->setDescription($description);
        $recipe->setUserId($userId);

        if (!empty($this->request()->getFiles()['image']['name'])) {
            if($this->request()->getValue('oldImage')) {
                FileStorage::deleteFile($this->request()->getValue('oldImage'));
            }
            $newFileName = FileStorage::saveFile($this->request()->getFiles()['image']);
            if(!$newFileName) {
                return $this->redirect($this->url("recipe.recipe_form", ['You have to add an image']));
            }
            $recipe->setImagePath($newFileName);
        }
        $recipe->save();

        if (!$id) {
            $ingredients = $this->request()->getValue('ingredients');
            if (is_array($ingredients)) {
                $areIngredientsOk = $this->createRecipeIngredients($ingredients, $recipe->getId());
                if (!$areIngredientsOk) {
                    $this->delete($recipe->getId(), false);
                    return $this->redirect($this->url("recipe.recipe_form", ['Amount has to be set and it has to be > 0']));
                }
            }
        }
        return $this->redirect($this->url("recipe.users_recipes"));
    }

    public function createRecipeIngredients(array $ingredients, int $recipeId): bool {
        foreach ($ingredients as $ingredient) {
            $amount = $ingredient['amount'];
            if ($amount === '' || $amount < 1) {
                return false;
            }

            $recipeIngredient = new RecipeIngredient();
            $recipeIngredient->setRecipeId($recipeId);
            $recipeIngredient->setIngredientId($ingredient['id']);
            $recipeIngredient->setAmount($amount);
            $recipeIngredient->save();
        }

        return true;
    }

    public function delete($id = null, bool $withRedirect = true)
    {
        if (!$id) {
            $id = (int)$this->request()->getValue('id');
        }
        $recipe = Recipe::getOne($id);
        if ($recipe) {
            $recipeIngredients = RecipeIngredient::getAll('recipe_id = :recipe_id', ['recipe_id' => $id]);
            foreach ($recipeIngredients as $ri) {
                $ri->delete();
            }
            FileStorage::deleteFile($recipe->getImagePath());
            $recipe->delete();
        }
        if ($withRedirect) {
            return $this->redirect($this->url("recipe.users_recipes"));
        }
    }

    public function fetchRecipeIngredientsInfo(int $recipeId): array
    {
        $result = [];
        $recipeIngredients = RecipeIngredient::getAll('recipe_id = :recipe_id', ['recipe_id' => $recipeId]);

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