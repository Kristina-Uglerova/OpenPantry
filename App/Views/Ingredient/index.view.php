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
                            onclick="openModal('ingredientForm', this)"
                            data-id="<?= $ingredient->getId() ?>"
                            data-name="<?= htmlspecialchars($ingredient->getName()) ?>"
                            data-unit="<?= htmlspecialchars($ingredient->getUnit()) ?>">
                        <span class="bi bi-pencil-square"></span>
                    </button>
                    <button class="icon-button" onclick="<?= $link->url("ingredient.delete") ?>">
                        <span class="bi bi-trash"></span>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>