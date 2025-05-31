<?php

use App\Core\IAuthenticator;
use App\Core\LinkGenerator;

/** @var string $contentHTML */

?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <link rel="stylesheet" href="/public/css/styl.css">
    <script src="/public/js/script.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
<div id="modalOverlay" class="modal-overlay"></div>

<?php include __DIR__ . '/partials/navbar.view.php'; ?>

<div class="main-content">
    <?= $contentHTML ?>
</div>

<?php
include __DIR__ . '/partials/login_modal.view.php';
include __DIR__ . '/partials/create_acc_modal.view.php';
include __DIR__ . '/partials/ingredient_update_modal.view.php';
?>
</body>
</html>
