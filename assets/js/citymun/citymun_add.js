if (typeof citymun_add_form == "undefined") {
  $("#cmclass").select2();

  let citymun_add_form = document.querySelector("#form-add");
  let url = window.location.href;

  document.querySelector("#submit").addEventListener("click", (ev) => {
    let msg = "";
    let cmclass = document.querySelector("#cmclass");
    let cmdesc = document.querySelector("#cmdesc");

    let formdata = new FormData(citymun_add_form);
    ev.preventDefault();

    if (cmclass.options[cmclass.selectedIndex].value == "-1") {
      msg += "Please choose the classification<br>";
    }

    if (msg.length > 0) {
      Swal.fire({
        title: "Error!",
        icon: "warning",
        html: msg,
      });
    } else {
      Swal.fire({
        title: "Add City/Municipality?",
        text: cmdesc.value,
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
            .then((response) => {
              if (!response.ok) {
                throw new Error(response.statusText);
              }
            })
            .catch((error) => {
              Swal.showValidationMessage(`Request failed: ${error}`);
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
          }).then((res) => {
            window.location = "/citymunicipality/listing";
          });
        }
      });
    }
  });

  let latitude = document.querySelector("#latitude");
  let longitude = document.querySelector("#longitude");
  let number_inputs = [latitude, longitude];

  number_inputs.forEach((el) => {
    el.addEventListener("keypress", (ev) => {
      if (ev.key == "e") {
        ev.preventDefault();
      }
    });
  });
}
