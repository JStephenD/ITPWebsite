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

<!-- form validation -->
<script>
    const strengthText = ["", "bad 💩", "ok 😐", "decent 🙂", "solid 💪"];

    let strength = 0;
    let showPassword = false;
    let showPassword2 = false;
    let disabled = true;

    let validations = []
    let bar_1 = document.querySelector('.bar-1');
    let bar_2 = document.querySelector('.bar-2');
    let bar_3 = document.querySelector('.bar-3');
    let bar_4 = document.querySelector('.bar-4');
    let bar_5 = document.querySelector('.bar-5');
    let bars = [bar_1, bar_2, bar_3, bar_4, bar_5];
    let vali_1 = document.querySelector('.vali-1');
    let vali_2 = document.querySelector('.vali-2');
    let vali_3 = document.querySelector('.vali-3');
    let vali_4 = document.querySelector('.vali-4');
    let vali_5 = document.querySelector('.vali-5');
    let valis = [vali_1, vali_2, vali_3, vali_4, vali_5];
    let password_input = document.querySelector('#password');
    let password_repeat_input = document.querySelector('#password-repeat');
    let signup_button = document.querySelector('.signup_button');

    function validatePassword(e, repeat = '') {
        const password = e.value;

        if (repeat == 'repeat') {
            validations[4] = (password_input.value == password_repeat_input.value);
        } else {
            validations = [
                (password.length >= 5),
                (password.search(/[A-Z]/) > -1),
                (password.search(/[0-9]/) > -1),
                (password.search(/[$&+,:;=?@#]/) > -1)
            ];
        }
        console.log(validations);
        strength = validations.reduce((acc, cur) => acc + cur, 0);

        bars.forEach((bar, i) => {
            if (strength > i) {
                bar.classList.add('bar-show');
            } else {
                bar.classList.remove('bar-show');
            }
        });
        validations.forEach((val, i) => {
            let vali = valis[i];
            if (val) {
                vali.innerHTML = "✔️";
            } else {
                vali.innerHTML = "❌";
            }
        });

        if (strength < 5) {
            signup_button.setAttribute('disabled', "");
        } else {
            signup_button.removeAttribute('disabled');
        }
    }

    let toggle_password = document.querySelector('#toggle-password');
    let toggle_password2 = document.querySelector('#toggle-password2');

    togglePassword = function() {
        showPassword = !showPassword;
        password_input.type = showPassword ? 'text' : 'password';
        toggle_password.innerHTML = (showPassword ? '🙈' : '👁️');
    }

    togglePassword2 = function() {
        showPassword2 = !showPassword2;
        password_repeat_input.type = showPassword2 ? 'text' : 'password';
        toggle_password2.innerHTML = (showPassword2 ? '🙈' : '👁️');
    }
</script>

<script>
    window.addEventListener('load', () => {
        let url = window.location.href;
        let username = document.querySelector('#username');
        let form = document.querySelector('#signup-form');

        username.addEventListener('blur', (ev) => {
            let formdata = new FormData(form);
            formdata.set('checkUser', '')

            fetch(url, {
                    method: 'POST',
                    body: formdata
                })
                .then((res) => {
                    if (!res.ok) {
                        throw new Error(res.statusText)
                    }
                    console.log('res', res)
                    return res.json()
                })
                .then((json) => {
                    if (json.status == 500) {
                        Swal.fire({
                            title: 'Error',
                            text: json.responseText,
                            timer: 1000,
                            timerProgressBar: true
                        })
                        username.value = ''
                    }
                })
                .catch((err) => {
                    Swal.showValidationMessage(
                        `Response failed: ${err}`
                    )
                });
        });

        let signup = document.querySelector('#signup');

        signup.addEventListener('click', (ev) => {
            ev.preventDefault();
            let formdata = new FormData(form);

            Swal.fire({
                title: 'Confirm Sign up',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Proceed',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return fetch(url, {
                        method: 'POST',
                        body: formdata
                    })
                    .then((res) => {
                        if (!res.ok) {
                            throw new Error(res.statusText)
                        }
                    })
                    .catch((err) => {
                        Swal.showValidationMessage(
                            `Response failed: ${err}`
                        )
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
            .then((res) => {
                if (res.isConfirmed) {
                    Swal.fire({
                        title: 'Redirecting..',
                        timer: 1000,
                        timerProgressBar: true
                    }).then((res) => {
                        window.location = '/user/login?username=' + username.value
                    })
                }
            })
        });
    });
</script>