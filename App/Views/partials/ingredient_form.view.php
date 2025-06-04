<?php
/** @var array $data */
?>

<div id="ingredientForm" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('ingredientUpdateModal')">&times;</span>
        <h2 class="title">Update ingredient</h2>
        <form class="form-body" method="post" action="/updateIngredient">
            <label class="text" for="name">Name</label>
            <input type="text" name="name" value="<?= @$data['ingredient']?->getName() ?>">

            <label class="text" for="unit">Unit</label>
            <input type="text" name="unit" value="<?= @$data['ingredient']?->getUnit() ?>">

            <div class="button-container">
                <button type="submit" class="pill_button">Save changes</button>
            </div>
        </form>
    </div>
</div>