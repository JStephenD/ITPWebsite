if (typeof table_delete == "undefined") {
  $("#blist").DataTable();

  let table_delete = document.querySelectorAll(".table-delete");

  const custSwal = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-outline-warning btn-lg mr-2",
      cancelButton: "btn btn-secondary btn-lg ml-2",
    },
    buttonsStyling: false,
  });

  let formdata = new FormData();
  formdata.append('ajax', 'ajax');
  table_delete.forEach((el) => {
    el.addEventListener("click", (ev) => {
      let target = ev.target;
      let href = target.dataset.href;
      let name = target.dataset.name;

      custSwal.fire({
        icon: "warning",
        title: `Delete ${name} Record?`,
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: 'Yes, delete it!',
        showLoaderOnConfirm: true,
        preConfirm: async () => {
          return fetch(href, {
            method: 'POST',
            body: formdata
          })
            .then((res) => {
              if (!res.ok) {
                throw new Error(res.statusText);
              }
              res.text()
                .then(text => {
                  try {
                    json = JSON.parse(text);
                    status = json['status'];
                    statusText = json['statusText'];
                    response = json['response'];
                    if (status == 550 || statusText == 'Permission denied') {
                      window.location.href = response['redirect_url'];
                    }
                  } catch (err) { console.log(err); }
                })
            })
            .catch((error) => {
              Swal.showValidationMessage(`Request failed: ${error}`);
            });
        },
        allowOutsideClick: () => !Swal.isLoading(),
      })
        .then(res => {
          if (res.isConfirmed) {
            sidebar_barangay_listing.click();
          }
        })
    });
  });

  let addbrgy = document.querySelector('#addbrgy');
  addbrgy.addEventListener('click', (ev) => {
    ev.preventDefault();
    let formdata = new FormData();
    formdata.append("ajax", "ajax");

    fetch("/barangay/add", {
      method: "POST",
      body: formdata,
    })
      .then((res) => {
        return res.text();
      })
      .then((text) => {
        main_content.innerHTML = text;
        addExtJs("/assets/js/barangay/brgy_add.js");
        changeDrawerActive(sidebar_barangay_add);
        history.pushState("", "", "/barangay/add");
      });
  });
}
