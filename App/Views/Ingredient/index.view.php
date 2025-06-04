<?php
/** @var array $data */
/** @var \App\Core\LinkGenerator $link */

?>

<div class="ingredients-page">
    <h1 class="title">Ingredients</h1>
    <table class="ingredients-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Unit</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['ingredients'] as $ingredient): ?>
            <tr>
                <td><?= htmlspecialchars($ingredient->getName()) ?></td>
                <td><?= htmlspecialchars($ingredient->getUnit()) ?></td>
                <td>
                    <button class="icon-button"
                            data-id="<?= $ingredient->getId() ?>"
                            data-name="<?= htmlspecialchars($ingredient->getName()) ?>"
                            data-unit="<?= htmlspecialchars($ingredient->getUnit()) ?>"
                            onclick="openIngredientModal('ingredientForm', this)">
                        <span class="bi bi-pencil-square"></span>
                    </button>
                    <form method="post" action="<?= $link->url("ingredient.delete") ?>">
                        <input type="hidden" name="id" value="<?= $ingredient->getId() ?>">
                        <button type="submit" class="icon-button">
                            <span class="bi bi-trash"></span>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>