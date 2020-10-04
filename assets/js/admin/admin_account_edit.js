if (typeof form == 'undefined') {
    let form = document.querySelector('#admin-account-edit-form');
    let url = window.location.href;

    let submit_button = document.querySelector('#submit');
    submit_button.addEventListener('click', (ev) => {
        ev.preventDefault();

        let formdata = new FormData(form);

        let perms = [];
        document.querySelectorAll('input[name="perms[]"]').forEach(node => {
            if (node.checked) {
                perms.push(node.value);
            }
        })

        formdata.append('perms', perms);

        Swal.fire({
            title: 'Update User Details?',
            icon: 'question',
            showLoaderOnConfirm: true,
            preConfirm: async () => {
                return fetch(url, {
                    method: 'POST',
                    body: formdata
                }).then((res) => {
                    if (!res.ok) {
                        throw new Error(res.statusText);
                    }
                    res.json().then((json) => {
                        console.log(json);
                    })
                }).catch((err) => {
                    Swal.showValidationMessage(
                        `Request Failed: ${err}`
                    )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((res) => {
            if (res.isConfirmed) {
                Swal.fire({
                    title: 'Success!',
                    icon: 'success',
                    timer: 1000,
                    timerProgressBar: true
                })
            }
        })
    })
}