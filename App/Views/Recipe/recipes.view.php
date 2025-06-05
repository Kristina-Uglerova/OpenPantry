<?php
/** @var array $data */
/** @var \App\Core\LinkGenerator $link */

?>
<div class="recipes-page">
    <h1 class="title">All Recipes</h1>
    <div class="recipes-filter">
        <label class="search-input-label">
            <input type="text" id="searchResults" placeholder="Search recipes..." class="search-input" oninput="triggerRecipeSearch()">
        </label>
        <button class="icon-button">&#8942;</i></button>
    </div>
    <div id="filteredRecipes" class="recipes-grid">
        <?php foreach ($data['recipes'] as $recipe): ?>
            <a href="?c=recipe&a=recipe_detail&recipeId=<?= htmlspecialchars($recipe->getId()) ?>" class="recipe-card">
                <img class="picture" src="public/uploads/<?= htmlspecialchars($recipe->getImagePath()) ?>" alt=<?= htmlspecialchars($recipe->getName()) ?>>
                <h3 class="subtitle"><?= htmlspecialchars($recipe->getName()) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
</div>