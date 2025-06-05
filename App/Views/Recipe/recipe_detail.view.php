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
            <li>200g flour</li>
            <li>3 apples</li>
            <li>100g dark chocolate</li>
            <li>2 eggs</li>
            <li>1 tsp cinnamon</li>
        </ul>
    </div>

    <div class="recipe-body">
        <h2 class="subtitle">Instructions</h2>
        <p><?= htmlspecialchars($data['recipe']->getDescription()) ?></p>
    </div>
    <?php if ($_SESSION['user'] == $data['recipe']->getUserId()) : ?>
        <form method="post" action="<?= $link->url("recipe.delete") ?>">
            <input type="hidden" name="id" value="<?= $data['recipe']->getId() ?>">
            <button type="submit" class="icon-button">
                <span class="bi bi-trash"></span>
            </button>
        </form>
    <?php endif; ?>
</div>
