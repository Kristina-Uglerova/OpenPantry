<?php
/** @var array $data */
/** @var \App\Core\LinkGenerator $link */
?>
<div class="recipe-detail">
    <div class="recipe-header">
        <h1 class="title"><?= htmlspecialchars($data['recipe']->getName()) ?></h1>
        <img class="picture" src="public/uploads/<?= htmlspecialchars($data['recipe']->getImagePath()) ?>" alt=<?= htmlspecialchars($data['recipe']->getName()) ?>>
    </div>

    <div class="recipe-body">
        <h2 class="subtitle">Ingredients</h2>
        <ul class="ingredients-list">
            <?php foreach ($data['ingredients'] as $ingredient): ?>
                <li>
                    <?= htmlspecialchars($ingredient['amount']) ?>
                    <?= htmlspecialchars($ingredient['unit']) ?>
                    <?= htmlspecialchars($ingredient['name']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="recipe-body">
        <h2 class="subtitle">Instructions</h2>
        <p><?= htmlspecialchars($data['recipe']->getDescription()) ?></p>
    </div>
    <?php if (!empty($_SESSION['user']) && $_SESSION['user'] == $data['recipe']->getUserId()) : ?>
        <a href="?c=recipe&a=recipe_form&recipeId=<?= htmlspecialchars($data['recipe']->getId()) ?>" class="icon-button">
            <span class="bi bi-pencil-square"></span>
        </a>
        <form method="post" action="<?= $link->url("recipe.delete") ?>">
            <input type="hidden" name="id" value="<?= $data['recipe']->getId() ?>">
            <button type="submit" class="icon-button">
                <span class="bi bi-trash"></span>
            </button>
        </form>
    <?php endif; ?>
</div>
