<div class="container-fluid">
    <form method="POST" class="form" id="form-edit">
        <legend>Edit City / Municipality Information</legend>
        <span class="sep"></span>
        <div class="citymun">
            <select name="cmclass" class="select" required>
                <option value="City" <?= $cm['cmclass'] == 'city' ? 'selected' : ''; ?>>
                    City</option>
                <option value="Municipality" <?= $cm['cmclass'] == 'city' ? 'selected' : ''; ?>>
                    Municipality</option>
            </select>
            <img src="/assets/images/caret-square-up-solid.svg" alt="caret">
        </div>
        <div class="field">
            <input type="text" class="input" autocomplete="off" name="cmdesc" placeholder=" " required value="<?= $cm['cmdesc']; ?>">
            <label for="cmdesc" class="label">City/Municipality Description</label>
        </div>
        <div class="longlat">
            <div class="field input-latitude">
                <input type="number" step=".01" class="input" autocomplete="off" id="latitude" name="latitude" min="-90" max="90" placeholder=" " required value="<?= $cm['latitude']; ?>">
                <label for="latitude" class="label">Latitude</label>
            </div>
            <div class="field input-longitude">
                <input type="number" step=".01" min="-180" max="180" class="input" autocomplete="off" id="longitude" name="longitude" placeholder=" " required value="<?= $cm['longitude']; ?>">
                <label for="longitude" class="label">Longitude</label>
            </div>
        </div>
        <div class="field">
            <input type="text" class="input" autocomplete="off" name="remarks" placeholder=" " value="<?= $cm['remarks']; ?>">
            <label for="remarks" class="label">Remarks</label>
        </div>

        <div class="buttons">
            <button type="submit" class="btn btn-lg btn-success" id="update" name="update">
                <i class="fas fa-save"></i>Update</button>
            <a type="button" class="btn btn-lg btn-primary" name="listing" href="/citymunicipality/listing">
                <i class="fas fa-list-ul"></i>Listing</a>
        </div>
    </form>
</div>

<script>
    window.addEventListener('load', () => {
        let url = window.location.href;
        let form = document.querySelector('#form-edit');

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
                preConfirm: () => {
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
                        .then(json => {
                        })
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
    });
</script>