<?php

/** @var \App\Core\LinkGenerator $link */
/** @var \App\Auth\DummyAuthenticator $auth */

?>
<nav class="navbar">
    <ul>
        <li><a href="/">Domov</a></li>
        <li><a href="<?= $link->url("Recipe.recipes") ?>">Recepty</a></li>
        <li><a href="<?= $link->url("Ingredient.index") ?>">Suroviny</a></li>
        <li><a class="nav-link" href="<?= $link->url("Recipe.recipe_detail") ?>">Recept</a></li>
        <?php if ($auth->isLogged()) : ?>
            <li><a href="<?= $link->url("User.profile") ?>">Profile</a></li>
            <li><a href="<?= $link->url("Recipe.recipe_form") ?>">Create recipe</a></li>
        <?php endif; ?>
    </ul>
</nav>