<div class="container-fluid">
    <form method="POST" class="form" id="form-add">
        <legend>City / Municipality Form</legend>
        <span class="sep"></span>
        <div class="citymun">
            <select name="cmclass" id="cmclass" class="select" required>
                <option disabled value="-1" selected>Select Classification</option>
                <option value="City">City</option>
                <option value="Municipality">Municipality</option>
            </select>
            <img src="/assets/images/caret-square-up-solid.svg" alt="caret">
        </div>
        <div class="field">
            <input type="text" class="input" autocomplete="off" id="cmdesc" name="cmdesc" placeholder=" " required>
            <label for="cmdesc" class="label">City/Municipality Description</label>
        </div>
        <div class="longlat">
            <div class="field input-latitude">
                <input type="number" step=".01" class="input" autocomplete="off" id="latitude" name="latitude" min="-90" max="90" placeholder=" " required>
                <label for="latitude" class="label">Latitude</label>
            </div>
            <div class="field input-longitude">
                <input type="number" step=".01" min="-180" max="180" class="input" autocomplete="off" id="longitude" name="longitude" placeholder=" " required>
                <label for="longitude" class="label">Longitude</label>
            </div>
        </div>
        <div class="field">
            <input type="text" class="input" autocomplete="off" name="remarks" placeholder=" ">
            <label for="remarks" class="label">Remarks</label>
        </div>

        <div class="buttons">
            <button type="submit" class="btn btn-lg btn-success" name="save" id="submit">
                <i class="fas fa-save"></i>Save</button>
            <a type="button" class="btn btn-lg btn-primary" name="listing" href="/citymunicipality/listing">
                <i class="fas fa-list-ul"></i>Listing</a>
        </div>
    </form>
</div>

<script>
    window.onload = function () {
        let form = document.querySelector('#form-add');
        let url = window.location.href;

        document.querySelector('#submit').addEventListener('click', (ev) => {
            let msg = '';
            let cmclass = document.querySelector('#cmclass');
            let cmdesc = document.querySelector('#cmdesc');

            let formdata = new FormData(form);
            ev.preventDefault();

            if (cmclass.options[cmclass.selectedIndex].value == '-1') {
                msg += 'Please choose the classification<br>';
            }

            if (msg.length > 0) {
                Swal.fire({
                    title: 'Error!',
                    icon: 'warning',
                    html: msg,
                });
            } else {
                Swal.fire({
                    title: 'Add City/Municipality?',
                    text: cmdesc.value,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Proceed',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return fetch(url, {
                                method: 'POST',
                                body: formdata
                            })
                            .then((response) => {
                                if (!response.ok) {
                                    throw new Error(response.statusText)
                                }
                            })
                            .catch((error) => {
                                Swal.showValidationMessage(
                                    `Request failed: ${error}`
                                )
                            })
                    },
                    allowOutsideClick: () => !Swal.isLoading(),
                }).then((res) => {
                    if (res.isConfirmed) {
                        Swal.fire({
                            title: 'Success!',
                            icon: 'success',
                            timer: 1500,
                            timerProgressBar: true,
                        });
                        window.location = '/citymunicipality/listing'
                    }
                });
            }
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
    };
</script>