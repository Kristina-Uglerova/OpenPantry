<?php
/** @var \App\Core\LinkGenerator $link */
?>
<div id="messageModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('messageModal')">&times;</span>
        <p id="message"></p>
        <div class="button-container">
            <button type="submit" name="submit" class="pill_button" onclick="closeModal('messageModal')">Ok</button>
        </div>
    </div>
</div>