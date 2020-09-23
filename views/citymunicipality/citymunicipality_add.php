<main id="main" class="p-5">
    <form method="POST" class="form" id="form-add">
        <legend>City / Municipality Form</legend>
        <span class="sep"></span>
        <div class="citymun">
            <label for="cmclass">
                Location Classification
                <select name="cmclass" id="cmclass" class="select" required>
                    <option disabled value="-1" selected>Select Classification</option>
                    <option value="City">City</option>
                    <option value="Municipality">Municipality</option>
                </select>
                <label for="cmclass">
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
</main>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/citymun/citymun_add.js"></script>
<?php } ?>