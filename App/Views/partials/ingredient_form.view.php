<?php
/** @var array $data */
/** @var \App\Core\LinkGenerator $link */
?>

<div id="ingredientForm" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('ingredientForm')">&times;</span>
        <h2 class="title">Update ingredient</h2>
        <form class="form-body-vertical" method="post" action="<?= $link->url("ingredient.update") ?>">
            <label class="text" for="name">Name</label>
            <input type="text" name="name" required>

            <label class="text" for="unit">Unit</label>
            <input type="text" name="unit" required>

            <div class="button-container">
                <button type="submit" class="pill_button">Save changes</button>
            </div>
        </form>
    </div>
</div>