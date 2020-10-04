if (typeof form == 'undefined') {
    let form = document.querySelector('#customer-add-form');
    let url = window.location.href;

    let citymun_select = $('#citymun');
    let barangay_select = $('#barangay');

    citymun_select.select2();
    barangay_select.select2();

    fetch('/ajaj/getCMLocs.php')
        .then((res) => {
            if (res.ok) {
                res.json().then((json) => {
                    json.forEach((row) => {
                        citymun_select.append(new Option(
                            row.cmdesc,
                            row.id,
                        ))
                    })

                    citymun_select.select2();
                })
            }
        });

    citymun_select.on('select2:select', (ev) => {
        citymun_filter = ev.params.data.text;
        idcm = ev.params.data.id;

        if (idcm != '-1') {
            let formdata = new FormData();
            formdata.append('citymun_filter', citymun_filter);

            fetch('/ajaj/getBLocsFromCity.php', {
                method: 'POST',
                body: formdata
            }).then((res) => {
                if (res.ok) {
                    res.json().then((json) => {
                        barangay_select.empty().trigger("change");
                        barangay_select.append(
                            '<option value="-1" selected disabled>Select Barangay</option>'
                        );

                        json.forEach((row) => {
                            if (row.idcm) {
                                barangay_select.append(new Option(
                                    row.bname,
                                    row.id,
                                ));
                            }
                        });
                        barangay_select.select2();
                    })
                }
            })
        }
    });

    let submit_button = document.querySelector('#submit');
    submit_button.addEventListener('click', (ev) => {
        ev.preventDefault();

        let formdata = new FormData(form);
        Swal.fire({
            title: 'Add Customer Profile?',
            icon: 'question',
            showLoaderOnConfirm: true,
            preConfirm: async () => {
                return fetch(url, {
                    method: 'POST',
                    body: formdata
                }).then((res) => {
                    if (res.ok) {
                        res.json().then((json) => {
                            // console.log(json);
                        })
                    }
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((res) => {
            if (res.isConfirmed) {
                Swal.fire({
                    title: 'success',
                    icon: 'success',
                    timer: 1000,
                    timerProgressBar: true
                })
            }
        })
    })
}