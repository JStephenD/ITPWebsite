if (typeof form == 'undefined') {
    let url = window.location.href;
    let form = document.querySelector('#form-edit');

    id = window.location.pathname.match('/citymunicipality/edit/(\\d+)')[1];
    let formdata = new FormData();
    formdata.append('id', id);

    fetch('/ajaj/getCitymunRecord.php', {
        method: 'POST',
        body: formdata
    })
        .then(res => {
            if (res.ok) {
                res.json()
                    .then(json => {
                        let cmclass = document.querySelector('#cmclass');
                        cmclass.append(new Option('City', 'City', true, (json['cmclass'] == 'City')));
                        cmclass.append(new Option('Municipality', 'Municipality', false, (json['cmclass'] == 'Municipality')));
                        $('#cmclass').select2();

                        document.querySelector('[name="cmdesc"]').value = json['cmdesc'];
                        document.querySelector('#latitude').value = json['latitude'];
                        document.querySelector('#longitude').value = json['longitude'];
                        document.querySelector('#remarks').value = json['remarks'];
                    })
            }
        })

    document.querySelector('#update').addEventListener('click', (ev) => {
        ev.preventDefault();
        let formdata = new FormData(form);

        Swal.fire({
            title: 'Update City/Municipality data?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Proceed',
            showLoaderOnConfirm: true,
            preConfirm: async () => {
                return fetch(url, {
                    method: 'POST',
                    body: formdata,
                })
                    .then((res) => {
                        if (!res.ok) {
                            throw new Error(res.statusText)
                        }
                        return res.json()
                    })
                    .then(json => { })
                    .catch((error) => {
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((res) => {
            if (res.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Edited Successfully',
                    timer: 1000,
                    timerProgressBar: true
                })
            };
        });
    });

    let latitude = document.querySelector('#latitude');
    let longitude = document.querySelector('#longitude');
    let number_inputs = [latitude, longitude];

    number_inputs.forEach((el) => {
        el.addEventListener('keypress', (ev) => {
            if (ev.key == 'e') {
                ev.preventDefault();
            }
        });
    });
}