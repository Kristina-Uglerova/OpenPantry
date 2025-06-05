<?php

/** @var \App\Core\LinkGenerator $link */
/** @var \App\Auth\DummyAuthenticator $auth */


?>
<nav class="navbar">
    <ul>
        <li><a href="/">Domov</a></li>
        <li><a href="<?= $link->url("Recipe.recipes") ?>">Recipes</a></li>
        <?php if ($auth->isLogged()) : ?>
            <li><a href="<?= $link->url("Recipe.users_recipes") ?>">My recipes</a></li>
            <li><a href="<?= $link->url("Recipe.recipe_form") ?>">Create recipe</a></li>
            <?php if ($auth->isUserAdmin()) : ?>
                <li><a href="<?= $link->url("Ingredient.index") ?>">Ingredients</a></li>
            <?php endif; ?>
            <li><a href="<?= $link->url("Auth.logout") ?>" class="small_pill_button">Logout</a></li>
        <?php endif; ?>
    </ul>
</nav>