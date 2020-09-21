if (typeof table_delete == "undefined") {
  $("#cmlist").DataTable();

  let table_delete = document.querySelectorAll(".table-delete");

  const custSwal = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-outline-warning btn-lg mr-2",
      cancelButton: "btn btn-secondary btn-lg ml-2",
    },
    buttonsStyling: false,
  });

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
        confirmButtonText: `<a href=${href}>Yes, delete it!</a>`,
      });
    });
  });
}
