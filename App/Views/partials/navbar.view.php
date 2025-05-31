<?php

/** @var \App\Core\LinkGenerator $link */


?>
<nav class="navbar">
    <ul>
        <li><a href="/">Domov</a></li>
        <li><a href="<?= $link->url("Recipe.all_recipes") ?>">Recepty</a></li>
        <li><a href="<?= $link->url("Ingredient.ingredients") ?>">Suroviny</a></li>
        <li><a class="nav-link" href="<?= $link->url("Recipe.recipe_detail") ?>">Recept</a></li>
    </ul>
</nav>

