formData_to_jsonstringify = function(formdata) {
    let obj = {};
    formdata.forEach((value, key) => {
        obj[key] = value;
    });
    
    return JSON.stringify(obj);
};

window.onload = function () {
    let sidebar_logout = document.querySelector('#sidebar-logout');
    let sidebar_account = document.querySelector('#sidebar-account');
    let sidebar_signup = document.querySelector('#sidebar-signup');
    let sidebar_login = document.querySelector('#sidebar-login');

    sidebar_logout.addEventListener('click', (ev) => {
        ev.preventDefault();

        Swal.fire({
            title: 'Confirm Logout',
            icon: 'warning',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch('/user/logout', {
                    method: 'POST',
                })
                .then((res) => {
                    if (!res.ok) {
                        throw new Error(res.statusText)
                    }
                })
                .catch((error) => {
                    Swal.showValidationMessage(
                        `Response failed: ${error}`
                    )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        })
        .then((res) => {
            window.location = '/user/login';
        });
    });
}