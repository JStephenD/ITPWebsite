<div class="container">
    <main>
        <form method="POST" class="signup-form" id="signup-form">
            <div class="field">
                <input type="text" name="username" class="input" id="username" placeholder=" " autocomplete="off">
                <label for="username" class="label">Username</label>
            </div>

            <div class="field">
                <input type="password" name="password" id="password" class="input" placeholder=" " autocomplete="off" oninput="validatePassword(this)" class="valid">
                <label for="password" class="label">Password</label>
                <span class="toggle-password" id="toggle-password" onmouseenter="togglePassword()" onmouseleave="togglePassword()">
                    👁️
                </span>
            </div>

            <div class="field">
                <input type="password" name="password-repeat" id="password-repeat" class="input" placeholder=" " autocomplete="off" oninput="validatePassword(this, 'repeat')" class="valid">
                <label for="password" class="label">Password</label>
                <span class="toggle-password" id="toggle-password2" onmouseenter="togglePassword2()" onmouseleave="togglePassword2()">
                    👁️
                </span>
            </div>

            <div class="strength">
                <span class="bar bar-1"></span>
                <span class="bar bar-2"></span>
                <span class="bar bar-3"></span>
                <span class="bar bar-4"></span>
                <span class="bar bar-5"></span>
            </div>

            <ul>
                <li><span class="vali-1">❌</span> must be at least 5 characters</li>
                <li><span class="vali-2">❌</span> must contain a capital letter</li>
                <li><span class="vali-3">❌</span> must contain a number</li>
                <li><span class="vali-4">❌</span> must contain one of $&+,:;=?@#</li>
                <li><span class="vali-5">❌</span> password match</li>
            </ul>

            <button class="signup_button" disabled name="signup" id="signup">Sign Up</button><br>
            <small><em>Already have an account? <a href="/user/login">Log In!</a></em></small>
        </form>
    </main>
</div>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/user/signup.js"></script>
<?php } ?>