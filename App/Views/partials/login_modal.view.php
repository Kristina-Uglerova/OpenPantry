<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('loginModal')">&times;</span>
        <h2 class="title">Sign in</h2>
        <form class="form-body" method="post" action="/login">
            <label class="text" for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label class="text" for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <div class="button-container">
                <button type="submit" class="pill_button">Submit</button>
            </div>
        </form>
    </div>
</div>