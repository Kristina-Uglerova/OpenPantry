<?php
/** @var array $data */
/** @var \App\Auth\DummyAuthenticator $auth */
?>

<div>
    <?php if (!empty($_GET['0'])): ?>
        <script>
            alert("<?= htmlspecialchars($_GET['0']) ?>");
        </script>
    <?php endif; ?>
    <div class="header">
        <div>
            <span class="title">DISCOVER AND SHARE NEW COMBINATIONS</span>
            <span class="text">Join us now and share your favourite recipes with others!</span>
            <?php if (!$auth->isLogged()) : ?>
                <div class="home_buttons">
                    <button onclick="openModal('loginModal')" class="pill_button">Sign in</button>
                    <button onclick="openModal('createAccountModal')" class="pill_button">Create new account</button>
                </div>
            <?php endif; ?>
        </div>
        <img src="/public/images/home_picture.jpg" alt="home" class="picture" />
    </div>
</div>