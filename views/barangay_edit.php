<div class="container-fluid">
    <form method="POST" class="form">
        <legend>Barangay Form</legend>
        <span class="sep"></span>
        <div class="select-section">
            <div class="citymun">
                <select name="idcm" id="citymun" class="select" required>
                    <?php if (isset($cityMunicipalities)) {
                    foreach ($cityMunicipalities as $row) { ?>
                        <option value="<?=$row['id'];?>" 
                            <?= $brngy['idcm'] == 
                            $row['id'] ? 'selected' : '' ;?>>
                            <?= $row['cmdesc']; ?>
                        </option>
                    <?php }} ?>
                </select>
                <img src="/assets/images/caret-square-up-solid.svg" alt="caret">
            </div>
            <div class="blevel">
                <select name="blevel" id="blevel" class="select">
                    <option value="Level 1" <?= $brngy['blevel'] == 'level 1' ? 'selected':'';?>>Level 1</option>
                    <option value="Level 2" <?= $brngy['blevel'] == 'level 2' ? 'selected':'';?>>Level 2</option>
                </select>
                <img src="/assets/images/caret-square-up-solid.svg" alt="caret">
            </div>
        </div>
        <div class="bnameestpop">
            <div class="field input-bname">
                <input type="text" class="input" autocomplete="off" name="bname" placeholder=" " required value="<?= $brngy['bname'] ;?>">
                <label for="bname" class="label">Barangay Name</label>
            </div>
            <div class="field input-estpop">
                <input id="estpop" type="number" class="input" autocomplete="off" name="estpop" placeholder=" " required value="<?= $brngy['estpop'] ;?>">
                <label for="estpop" class="label">Estimated Population</label>
            </div>
        </div>
        <div class="longlat">
            <div class="field input-latitude">
                <input id="latitude" type="number" step=".01" class="input" autocomplete="off" 
                name="latitude" min="-90" max="90" placeholder=" " required
                value="<?= $brngy['latitude'] ;?>">
                <label for="latitude" class="label">Latitude</label>
            </div>
            <div class="field input-longitude">
                <input id="longitude" type="number" step=".01" min="-180" max="180" class="input" 
                autocomplete="off" name="longitude" placeholder=" " required
                value="<?= $brngy['longitude'] ;?>">
                <label for="longitude" class="label">Longitude</label>
            </div>
        </div>
        <div class="field">
            <input type="text" class="input" autocomplete="off" name="remarks" 
            placeholder=" " required
            value="<?= $brngy['remarks'] ;?>">
            <label for="remarks" class="label">Remarks</label>
        </div>

        <div class="buttons">
            <button type="submit" class="btn btn-lg btn-success" id="update" name="update">
                <i class="fas fa-save"></i>Save</button>
            <a class="btn btn-lg btn-primary" name="listing" href="/barangay/listing">
                <i class="fas fa-list-ul"></i>Listing</a>
        </div>
    </form>
</div>

<script defer>
    let update = document.querySelector('#update');
    update.addEventListener('click', (ev) => {
        if (confirm("Are you sure to update Barangay?")) {
            return true;
        } else {
            return false;
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
</script>