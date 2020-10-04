if (typeof form == 'undefined') {
    let form = document.querySelector('#customer-log-form');
    let url = window.location.href;

    let date_input = $('#date');
    let time_input = $('#time');
    let set_current_time = $('#set-current-time');

    date_input.on('keydown', () => false);
    time_input.on('keydown', () => false);

    date_input.datepicker();
    time_input.timepicker();

    set_current_time.on('click', () => {
        let now = new Date();
        date_input.datepicker('setDate', now);
        time_input.timepicker('setTime', now);
    });

    set_current_time.click();

    let customer_select = $('#customer-id');
    customer_select.select2();

    document.querySelector('#submit').addEventListener('click', (ev) => {
        ev.preventDefault();
        let formdata = new FormData(form);
        let temp_date = formdata.get('date');
        let x = temp_date.match(/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/);
        formdata.set('date', `${x[3]}-${x[2]}-${x[1]}`)

        let msg = '';

        if (!formdata.get('customer-id')) {
            msg += '&raquo; Select Customer<br>'
        }
        if (!formdata.get('date')) {
            msg += '&raquo; Select Date<br>'
        }
        if (!formdata.get('time')) {
            msg += '&raquo; Select Time<br>'
        }
        if (!formdata.get('temp')) {
            msg += '&raquo; Enter Customer Temperature (celcius)'
        }

        if (msg) {
            Swal.fire({
                title: 'Error',
                html: msg,
                icon: 'warning',
                timer: 2000,
                timerProgressBar: true
            });
            return;
        }

        Swal.fire({
            title: 'Confirm Customer Logging',
            showLoaderOnConfirm: true,
            preConfirm: async () => {
                return fetch(url, {
                    method: 'POST',
                    body: formdata
                }).then(res => {
                    if (!res.ok) {
                        throw new Error(response.statusText)
                    }
                    return res.json()
                }).then(json => {

                }).catch(err => {
                    Swal.showValidationMessage(
                        `Request failed: ${err}`
                    )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(res => {
            if (res.isConfirmed) {
                Swal.fire({
                    title: 'Success',
                    icon: 'success',
                    timer: 1000,
                    timerProgressBar: true
                });
                window.location.href = '/tracing/customer';
            }
        })
    });

    customer_select.on('select2:select', (ev) => {
        console.log(ev.params.data)
    })
}