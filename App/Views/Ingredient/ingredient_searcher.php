<?php
/** @var \App\Core\LinkGenerator $link */
?>
<div id="ingredientSearcher" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('ingredientSearcher')">&times;</span>
        <h2 class="title">Add ingredients</h2>
        <input type="text" id="ingredientSearchBar" placeholder="Search ingredients..." class="search-input">
        <ul id="searchResults"></ul>
        <div class>
            <h3 class="subtitle">New ingredient</h3>
            <form id="newIngredientForm" class="form-body-horizontal" method="post" action="<?= $link->url("ingredient.save")?>">
                <input type="text" id="name" name="name" placeholder="Name" class="search-input">
                <input type="text" id="unit" name="unit" placeholder="Unit" class="search-input">
                <button class="small_pill_button">Add</button>
            </form>
        </div>

        <div>
            <h3 class="subtitle">Selected ingredients</h3>
            <ul id="selectedIngredients"></ul>
        </div>
        <div class="button-container">
            <button class="small_pill_button" onclick="submitIngredients()">Submit</button>
        </div>
    </div>
</div>

<script type="module">
    const form = document.getElementById('newIngredientForm')
    form.addEventListener('submit', function(event){
        event.preventDefault()
        const formData = new FormData(form);
        fetch(form.action, {
            method: form.method,
            body: formData
        })
        form.reset()
    })
</script>