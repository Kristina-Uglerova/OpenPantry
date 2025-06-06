<?php
/** @var array $data */
?>

<div class="header">
    <div class="text-center text-danger mb-3">
        <?= @$_GET['0'] ?>
    </div>
        <div>
            <span class="title">DISCOVER AND SHARE NEW COMBINATIONS</span>
            <span class="text">Join us now and share your favourite recipes with others!</span>

            <div class="home_buttons">
                <button onclick="openModal('loginModal')" class="pill_button">Sign in</button>
                <button onclick="openModal('createAccountModal')" class="pill_button">Create new account</button>
            </div>
        </div>
        <img src="/public/images/home_picture.jpg" alt="home" class="picture" />
</div>