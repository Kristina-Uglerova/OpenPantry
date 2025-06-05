<?php
/** @var array $data */
/** @var \App\Core\LinkGenerator $link */

?>
<div class="recipes-page">
    <h1 class="title">My Recipes</h1>
    <div class="recipes-grid">
        <?php foreach ($data['recipes'] as $recipe): ?>
            <a href="?c=recipe&a=recipe_detail&recipeId=<?= htmlspecialchars($recipe->getId()) ?>" class="recipe-card">
                <img class="picture" src="public/uploads/<?= htmlspecialchars($recipe->getImagePath()) ?>" alt=<?= htmlspecialchars($recipe->getName()) ?>>
                <h3 class="subtitle"><?= htmlspecialchars($recipe->getName()) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
</div>