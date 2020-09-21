if (typeof brgy_add_form == "undefined") {
  $("#citymun").select2();
  $("#blevel").select2();

  let brgy_add_form = document.querySelector("#form-add");
  let url = window.location.href;

  document.querySelector("#submit").addEventListener("click", (ev) => {
    let msg = "";
    let citymun = document.querySelector("#citymun");
    let blevel = document.querySelector("#blevel");
    let bname = document.querySelector("#bname");
    let formdata = new FormData(brgy_add_form);
    ev.preventDefault();

    if (citymun.options[citymun.selectedIndex].value == "-1") {
      msg += "Please choose the city<br>";
    }
    if (blevel.options[blevel.selectedIndex].value == "-1") {
      msg += "Please select the level";
    }
    if (msg.length > 0) {
      Swal.fire({
        title: "Error!",
        icon: "warning",
        html: msg,
      });
    } else {
      Swal.fire({
        title: "Add Barangay?",
        text: bname.value,
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Proceed",
        showLoaderOnConfirm: true,
        preConfirm: async () => {
          return fetch(url, {
            method: "POST",
            body: formdata,
          })
            .then((res) => {
              if (!res.ok) {
                throw new Error(res.responseText);
              }
            })
            .catch((error) => {
              Swal.showValidationMessage(`Response failed: ${error}`);
            });
        },
        allowOutsideClick: () => !Swal.isLoading(),
      }).then((res) => {
        if (res.isConfirmed) {
          Swal.fire({
            title: "Success!",
            icon: "success",
            timer: 1000,
            timerProgressBar: true,
          });
        }
      });
    }
  });

  let latitude = document.querySelector("#latitude");
  let longitude = document.querySelector("#longitude");
  let estpop = document.querySelector("#estpop");
  let number_inputs = [latitude, longitude, estpop];

  number_inputs.forEach((el) => {
    el.addEventListener("keypress", (ev) => {
      if (ev.key == "e") {
        ev.preventDefault();
      }
    });
  });
  estpop.addEventListener("change", (ev) => {
    let target = ev.target;
    if (target.value < 0) {
      target.value = 0;
    }
  });
}
