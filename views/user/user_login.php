<div class="container">
    <main>
        <form method="POST" class="login-form">
            <div class="field">
                <input type="text" name="username" class="input" placeholder=" " value="<?= isset($_GET['username']) ? $_GET['username'] : ''; ?>" autocomplete="off">
                <label for="username" class="label">Username</label>
            </div>

            <div class="field">
                <input type="password" name="password" id="password" class="input" placeholder=" " autocomplete="off" oninput="validatePassword(this)" class="valid">
                <label for="password" class="label">Password</label>
                <span class="toggle-password" id="toggle-password" onmouseenter="togglePassword()" onmouseleave="togglePassword()">
                    👁️
                </span>
            </div>

            <div class="strength">
                <span class="bar bar-1"></span>
                <span class="bar bar-2"></span>
                <span class="bar bar-3"></span>
                <span class="bar bar-4"></span>
            </div>

            <ul>
                <li><span class="vali-1">❌</span> must be at least 5 characters</li>
                <li><span class="vali-2">❌</span> must contain a capital letter</li>
                <li><span class="vali-3">❌</span> must contain a number</li>
                <li><span class="vali-4">❌</span> must contain one of $&+,:;=?@#</li>
            </ul>

            <button class="login_button" disabled name="login">Login</button><br>
            <small><em>Don't have an account? <a href="/user/signup">Sign Up!</a></em></small>
        </form>
    </main>
</div>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/user/login.js"></script>
<?php } ?>