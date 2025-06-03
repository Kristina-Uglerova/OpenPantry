<?php
/** @var \App\Models\Ingredient[] $ingredients */
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
        <?php foreach ($ingredients as $ingredient): ?>
            <tr>
                <td><?= htmlspecialchars($ingredient->getName()) ?></td>
                <td><?= htmlspecialchars($ingredient->getUnit()) ?></td>
                <td>
                    <button class="icon-button" onclick="openModal('ingredientUpdateModal', <?= $ingredient->getId() ?>)">
                        <span class="bi bi-pencil-square"></span>
                    </button>
                    <button class="icon-button">
                        <span class="bi bi-trash"></span>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>