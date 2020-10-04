if (typeof form == 'undefined') {
    let form = document.querySelector('#form-update');

    let rFile = document.querySelector('#rFile');
    let fBtn = document.querySelector('#fBtn');
    let showImg = document.querySelector('#showImg');

    let updatedDP = false;

    fBtn.addEventListener('click', () => {
        rFile.click();
    });

    rFile.addEventListener('change', () => {
        let formdata = new FormData(form);
        let url = window.location.href;
        updatedDP = true;

        formdata.delete('first-name');
        formdata.delete('last-name');
        formdata.delete('birthday');
        formdata.append('dp_upload', 'dp_upload');
        formdata.append('updatedDP', updatedDP);

        fetch(url, {
            method: 'POST',
            body: formdata
        })
            .then(res => {
                if (res.ok) {
                    return res.json();
                }
            })
            .then(json => {
                showImg.src = '../' + json['dp_url'];
                sidebar_dp_img.src = '../' + json['dp_url'];
            })
    });

    let update = document.querySelector('#update');
    update.addEventListener('click', (ev) => {
        let formdata = new FormData(form);
        let url = window.location.href;
        ev.preventDefault();

        formdata.append('updatedDP', updatedDP);

        Swal.fire({
            title: "Update Profile?",
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
                    header: {
                        'accepts': 'application/json'
                    }
                })
                    .then((res) => {
                        if (!res.ok) {
                            throw new Error(res.responseText);
                        }
                        return res.json();
                    })
                    .then((json) => {
                        showImg.src = '../' + json['dp_url'];
                        sidebar_dp_img.src = '../' + json['dp_url'];
                        sidebar_dp_txt.innerHTML = json['first_name'];
                        sidebar_user_txt.innerHTML = 'User' + json['first_name'];
                    })
                    .catch((error) => {
                        Swal.showValidationMessage(`Response failed: ${error}`);
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
                });
                window.location.href = '/user/account';
            }
        });
    });
}