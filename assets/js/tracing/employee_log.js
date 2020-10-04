if (typeof form == 'undefined') {
    let form = document.querySelector('#employee-log-form');
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

    let employees_select = $('#employee-id');
    employees_select.select2();

    let add_employee = document.querySelector('#add-employee');
    add_employee.addEventListener('click', async (ev) => {
        ev.preventDefault();

        Swal.mixin({
            confirmButtonText: 'Next &rarr;',
            title: 'Add Employee Profile',
            showCancelButton: true,
            progressSteps: ['1', '2', '3', '4', '5', '6']
        }).queue([
            { input: 'text', text: 'First Name' },
            { input: 'text', text: 'Last Name' },
            { input: 'text', text: 'Phone Number', inputValue: '+63' },
            { input: 'email', text: 'Email' },
            { input: 'text', text: 'Position' },
            { input: 'text', text: 'Birthday yyyy-mm-dd' }
        ]).then((result) => {
            if (result.value) {
                [
                    first_name,
                    last_name,
                    phone_number,
                    email,
                    position,
                    birthday
                ] = result.value;

                let formdata = new FormData();
                formdata.append('first-name', first_name);
                formdata.append('last-name', last_name);
                formdata.append('phone-number', phone_number);
                formdata.append('email', email);
                formdata.append('position', position);
                formdata.append('birthday', birthday);

                Swal.fire({
                    title: 'Adding Employee Profile',
                    icon: 'info',
                    showLoaderOnConfirm: true,
                    showCancelButton: false,
                    preConfirm: async () => {
                        return fetch('/tracing/employee/add', {
                            method: 'POST',
                            body: formdata
                        }).then((res) => {
                            if (!res.ok) {
                                throw new Error(response.statusText)
                            }
                            return res.json()
                        }).then((json) => {
                            return json;
                        }).catch((err) => {
                            Swal.showValidationMessage(
                                `Request failed: ${err}`
                            )
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then(res => {
                    Swal.fire({
                        title: res.value.responseText,
                        icon: 'success',
                        timer: 1000,
                        timerProgressBar: true,
                    })

                    fetch('/ajaj/tracing/getEmployees.php')
                        .then((res) => {
                            if (res.ok) {
                                res.json().then((json) => {
                                    employees_select.empty().trigger('change');
                                    employees_select.append(
                                        '<option disabled selected value="-1">Select Employee</option>'
                                    );

                                    json.forEach((row) => {
                                        employees_select.append(new Option(
                                            `${row.last_name}, 
                                            ${row.first_name}`,
                                            row.id,
                                        ));
                                    })
                                    employees_select.select2();
                                })
                            }
                        })
                        .catch((err) => {
                            console.log(err)
                        })
                });

                Swal.clickConfirm();
            }
        });
    });

    document.querySelector('#submit').addEventListener('click', (ev) => {
        ev.preventDefault();
        let formdata = new FormData(form);
        let temp_date = formdata.get('date');
        let x = temp_date.match(/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/);
        formdata.set('date', `${x[3]}-${x[2]}-${x[1]}`)

        let msg = '';

        if (!formdata.get('employee-id')) {
            msg += '&raquo; Select Employee<br>'
        }
        if (!formdata.get('date')) {
            msg += '&raquo; Select Date<br>'
        }
        if (!formdata.get('time')) {
            msg += '&raquo; Select Time<br>'
        }
        if (!formdata.get('temp')) {
            msg += '&raquo; Enter Employee Temperature (celcius)'
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
            title: 'Confirm Employee Logging',
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
                sidebar_tracing_employee.click();
            }
        })
    });
}