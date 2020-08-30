<!-- main content -->

<!-- form -->
<div class="container-fluid">
    <form method="POST" class="form">
        <legend>Barangay Form</legend>
        <span class="sep"></span>
        <div class="citymun">
            <select name="idcm" class="select" required>
                <option disabled selected>Select City</option>
                <?php if (isset($cityMunicipalities)) {
                foreach ($cityMunicipalities as $row) { ?>
                <option value="<?=$row['id'];?>">
                    <?=$row['cmdesc'];?>
                </option>
                <?php }} ?>
            </select>
            <img src="/assets/images/caret-square-up-solid.svg" alt="caret">
        </div>
        <div class="field">
            <input type="text" class="input" autocomplete="off" name="bname" placeholder=" " required>
            <label for="bname" class="label">Barangay Name</label>
        </div>
        <div class="longlat">
            <div class="field">
                <input type="number" step=".01" class="input" autocomplete="off" name="latitude" min="-90" max="90" placeholder=" " required>
                <label for="latitude" class="label">Latitude</label>
            </div>
            <div class="field">
                <input type="number" step=".01" min="-180" max="180" class="input" autocomplete="off" name="longitude" placeholder=" " required>
                <label for="longitude" class="label">Longitude</label>
            </div>
        </div>
        <div class="field">
            <input type="text" class="input" autocomplete="off" name="remarks" placeholder=" " required>
            <label for="remarks" class="label">Remarks</label>
        </div>

        <div class="buttons">
            <button type="submit" class="btn-save" name="save">Save</button>
            <button type="submit" class="btn-listing" name="listing">Listing</button>
        </div>
    </form>
</div>