<div class="container-fluid">
    <form method="POST" class="form">
        <legend>Barangay Form</legend>
        <span class="sep"></span>
        <div class="citymun">
            <select name="idcm" class="select" required>
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
        <div class="field">
            <input type="text" class="input" autocomplete="off" name="bname" placeholder=" " 
            required
            value="<?= $brngy['bname'] ;?>">
            <label for="bname" class="label">Barangay Name</label>
        </div>
        <div class="longlat">
            <div class="field">
                <input type="number" step=".01" class="input" autocomplete="off" 
                name="latitude" min="-90" max="90" placeholder=" " required
                value="<?= $brngy['latitude'] ;?>">
                <label for="latitude" class="label">Latitude</label>
            </div>
            <div class="field">
                <input type="number" step=".01" min="-180" max="180" class="input" 
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
            <button type="submit" class="btn btn-lg btn-success" name="update">
                <i class="fas fa-save"></i>Save</button>
            <a class="btn btn-lg btn-primary" name="listing" href="barangay/listing">
                <i class="fas fa-list-ul"></i>Listing</a>
        </div>
    </form>
</div>