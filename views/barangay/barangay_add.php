<!-- main content -->

<!-- form -->
<div class="container-fluid">
    <form method="POST" class="form" id="form-add">
        <legend>Barangay Form</legend>
        <span class="sep"></span>
        <div class="select-section">
            <label for="citymun">
                Select Location
                <div class="citymun">
                    <select name="idcm" id="citymun" class="select" required>
                        <option value="-1" disabled selected>Select City</option>
                        <?php if (isset($cityMunicipalities)) {
                            foreach ($cityMunicipalities as $row) { ?>
                                <option value="<?= $row['id']; ?>">
                                    <?= $row['cmdesc']; ?>
                                </option>
                        <?php }
                        } ?>
                    </select>
                </div>
            </label>
            <label for="blevel">
                Select Barangay Level
                <div class="blevel">
                    <select name="blevel" id="blevel" class="select">
                        <option value="-1" disabled selected>Select Level</option>
                        <option value="Level 1">Level 1</option>
                        <option value="Level 2">Level 2</option>
                    </select>
                </div>
            </label>
        </div>
        <div class="bnameestpop">
            <div class="field input-bname">
                <input type="text" id="bname" class="input" autocomplete="off" name="bname" placeholder=" " required>
                <label for="bname" class="label">Barangay Name</label>
            </div>
            ` <div class="field input-estpop">
                <input id="estpop" type="number" class="input" autocomplete="off" name="estpop" placeholder=" " required>
                <label for="estpop" class="label">Estimated Population</label>
            </div>
        </div>
        <div class="longlat">
            <div class="field input-latitude">
                <input id="latitude" type="number" step=".01" class="input" autocomplete="off" name="latitude" min="-90" max="90" placeholder=" " required>
                <label for="latitude" class="label">Latitude</label>
            </div>
            <div class="field input-longitude">
                <input id="longitude" type="number" step=".01" min="-180" max="180" class="input" autocomplete="off" name="longitude" placeholder=" " required>
                <label for="longitude" class="label">Longitude</label>
            </div>
        </div>
        <div class="field">
            <input type="text" class="input" autocomplete="off" name="remarks" placeholder=" ">
            <label for="remarks" class="label">Remarks</label>
        </div>

        <div class="buttons">
            <button type="submit" class="btn btn-lg btn-success" id="submit" name="save">
                <i class="fas fa-save"></i>Save</button>
            <a class="btn btn-lg btn-primary" name="listing" href="/barangay/listing">
                <i class="fas fa-list-ul"></i>Listing</a>
        </div>
    </form>
</div>

<script>
    window.addEventListener('load', () => {
        $('#citymun').select2();
        $('#blevel').select2();

        let form = document.querySelector('#form-add');
        let url = window.location.href;

        document.querySelector('#submit').addEventListener('click', (ev) => {
            let msg = '';
            let citymun = document.querySelector('#citymun');
            let blevel = document.querySelector('#blevel');
            let bname = document.querySelector('#bname');
            let formdata = new FormData(form);
            ev.preventDefault();

            if (citymun.options[citymun.selectedIndex].value == '-1') {
                msg += 'Please choose the city<br>';
            }
            if (blevel.options[blevel.selectedIndex].value == '-1') {
                msg += 'Please select the level';
            }
            if (msg.length > 0) {
                Swal.fire({
                    title: 'Error!',
                    icon: 'warning',
                    html: msg,
                });
            } else {
                Swal.fire({
                    title: 'Add Barangay?',
                    text: bname.value,
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
                            .then((res) => {
                                if (!res.ok) {
                                    throw new Error(res.responseText)
                                }
                            })
                            .catch((error) => {
                                Swal.showValidationMessage(
                                    `Response failed: ${error}`
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
                            timerProgressBar: true,
                        })
                    }
                });
            }
        });

        let latitude = document.querySelector('#latitude');
        let longitude = document.querySelector('#longitude');
        let estpop = document.querySelector('#estpop');
        let number_inputs = [latitude, longitude, estpop];

        number_inputs.forEach((el) => {
            el.addEventListener('keypress', (ev) => {
                if (ev.key == 'e') {
                    ev.preventDefault();
                }
            });
        });
        estpop.addEventListener('change', (ev) => {
            let target = ev.target;
            if (target.value < 0) {
                target.value = 0;
            }
        });
    });
</script>