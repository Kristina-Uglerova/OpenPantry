<?php
/** @var array $data */
/** @var \App\Core\LinkGenerator $link */

$recipe = $data['recipe'] ?? null;
?>

<div class="recipe-detail">
    <h1 class="title"><?= $recipe ? 'Edit Recipe' : 'Add New Recipe' ?></h1>

    <form id="recipeEntryForm" class="form-body-vertical" method="post" action="<?= $link->url("recipe.save") ?>" enctype="multipart/form-data">
        <?php if ($recipe): ?>
            <input type="hidden" name="id" value="<?= $recipe->getId() ?>">
        <?php endif; ?>

        <label class="text" for="title">Title</label>
        <input type="text" id="title" name="title" required
               value="<?= $recipe ? htmlspecialchars($recipe->getName()) : '' ?>">

        <label class="text" for="ingredients">Ingredients</label>
        <button class="pill_button" type="button" id="openIngredientsBtn" onclick="openModal('ingredientSearcher')">Modify ingredients</button>

        <label class="text" for="description">Description</label>
        <textarea id="description" name="description" rows="5" required><?= $recipe ? htmlspecialchars($recipe->getDescription()) : '' ?></textarea>

        <label class="text" for="image">Image</label>

        <?php if ($recipe && $recipe->getImagePath()): ?>
            <div class="current-image">
                <p>Current image:</p>
                <img src="/public/uploads/<?= htmlspecialchars($recipe->getImagePath()) ?>" alt="Recipe image" style="max-width: 300px; margin-bottom: 10px;">
            </div>
        <?php endif; ?>

        <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg, image/webp">

        <div class="button-container">
            <button type="submit" class="pill_button">
                <?= $recipe ? 'Update Recipe' : 'Create Recipe' ?>
            </button>
        </div>
    </form>
</div>
