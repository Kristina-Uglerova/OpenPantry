<?php
/** @var \App\Models\Recipe|null $recipe */
/** @var \App\Core\LinkGenerator $link */

?>

<div class="recipe-detail">
    <h1 class="title"><?= isset($recipe) && $recipe !== null ? 'Edit Recipe' : 'Add New Recipe' ?></h1>

    <form class="form-body-vertical" method="post" action="<?= $link->url("recipe.save") ?>" enctype="multipart/form-data">
        <label class="text" for="title">Title</label>
        <input type="text" id="title" name="title" required
               value="<?= isset($recipe) && $recipe !== null ? htmlspecialchars($recipe->getTitle()) : '' ?>"
        >

        <label class="text" for="ingredients">Ingredients</label>
        <button class="pill_button" type="button" id="openIngredientsBtn" onclick="openModal('ingredientSearcher')">Modify ingredients</button>

        <label class="text" for="description">Description</label>
        <textarea id="description" name="description" rows="5" required
        ><?= isset($recipe) && $recipe !== null ? htmlspecialchars($recipe->getDescription()) : '' ?></textarea>

        <label class="text" for="image">Image</label>
        <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg, image/webp" required
               value="<?= isset($recipe) && $recipe !== null ? htmlspecialchars($recipe->getImage()) : '' ?>"
        >

        <div class="button-container">
            <button type="submit" class="pill_button">
                <?= isset($recipe) && $recipe !== null ? 'Update Recipe' : 'Create Recipe' ?>
            </button>
        </div>
    </form>
</div>