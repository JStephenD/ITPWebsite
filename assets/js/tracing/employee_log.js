if (typeof form == 'undefined') {
    let form = document.querySelector('#employee-log-form');

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
                                res.json()
                                    .then((json) => {
                                        employees_select.empty().trigger('change');
                                        employees_select.append(
                                            '<option disabled selected value="-1">Select Employee</option>'
                                        );

                                        json.forEach((row) => {
                                            employees_select.append(new Option(
                                                `${row.last_name}, 
                                                ${row.first_name}`,
                                                row.id,
                                                false,
                                                false
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
}