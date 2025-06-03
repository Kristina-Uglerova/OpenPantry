<?php
/** @var \App\Core\LinkGenerator $link */
?>
<div id="createAccountModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('createAccountModal')">&times;</span>
        <h2 class="title">Create account</h2>
        <form class="form-body" method="post" action="<?= $link->url("auth.register") ?>">
            <label class="text" for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label class="text" for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label class="text" for="confirm_password">Confirm password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <div class="button-container">
                <button type="submit" name="submit" class="pill_button">Submit</button>
            </div>
        </form>
    </div>
</div>