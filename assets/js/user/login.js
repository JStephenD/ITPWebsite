if (typeof form == "undefined") {
  let form = document.querySelector("#login-form");
  let username = document.querySelector("#username");
  let url = window.location.href;

  username.addEventListener("blur", (ev) => {
    if (username.value == "") return;
    let formdata = new FormData(form);
    formdata.append("checkUser", "");

    fetch(url, {
      method: "POST",
      body: formdata,
    })
      .then((res) => {
        if (!res.ok) {
          throw new Error(res.statusText);
        }
        return res.json();
      })
      .then((json) => {
        if (json.status == 500) {
          Swal.fire({
            title: "Error",
            icon: "warning",
            text: json.responseText,
            timer: 1000,
            timerProgressBar: true,
          });
          username.value = "";
        }
      })
      .catch((err) => {
        Swal.showValidationMessage(`Response failed: ${err}`);
      });
  });

  const strengthText = ["", "bad 💩", "ok 😐", "decent 🙂", "solid 💪"];

  let strength = 0;
  let showPassword = false;
  let disabled = true;

  let validations = [];
  let bar_1 = document.querySelector(".bar-1");
  let bar_2 = document.querySelector(".bar-2");
  let bar_3 = document.querySelector(".bar-3");
  let bar_4 = document.querySelector(".bar-4");
  let bars = [bar_1, bar_2, bar_3, bar_4];
  let vali_1 = document.querySelector(".vali-1");
  let vali_2 = document.querySelector(".vali-2");
  let vali_3 = document.querySelector(".vali-3");
  let vali_4 = document.querySelector(".vali-4");
  let valis = [vali_1, vali_2, vali_3, vali_4];
  let login_button = document.querySelector(".login_button");

  function validatePassword(e) {
    const password = e.value;

    validations = [
      password.length >= 5,
      password.search(/[A-Z]/) > -1,
      password.search(/[0-9]/) > -1,
      password.search(/[$&+,:;=?@#]/) > -1,
    ];
    strength = validations.reduce((acc, cur) => acc + cur, 0);

    bars.forEach((bar, i) => {
      if (strength > i) {
        bar.classList.add("bar-show");
      } else {
        bar.classList.remove("bar-show");
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

    if (strength < 4) {
      login_button.setAttribute("disabled", "");
    } else {
      login_button.removeAttribute("disabled");
    }
  }

  let toggle_password = document.querySelector("#toggle-password");
  let password_input = document.querySelector("#password");

  function togglePassword() {
    showPassword = !showPassword;
    password_input.type = showPassword ? "text" : "password";
    toggle_password.innerHTML = showPassword ? "🙈" : "👁️";
  }
}
