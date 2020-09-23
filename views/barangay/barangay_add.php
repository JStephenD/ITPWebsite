<main id="main" class="p-5">
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
</main>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/barangay/brgy_add.js"></script>
<?php } ?>