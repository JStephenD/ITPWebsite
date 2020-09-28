<main id="main" class="p-4">    
    <form method="POST" class="form" id="form-edit">
        <legend>Edit City / Municipality Information</legend>
        <span class="sep"></span>
        <div class="citymun">
            <label for="cmclass">
                Location Classification
                <select name="cmclass" id="cmclass" class="select" required>
                    <!-- <option value="City" <?= $cm['cmclass'] == 'city' ? 'selected' : ''; ?>>
                        City</option>
                    <option value="Municipality" <?= $cm['cmclass'] == 'city' ? 'selected' : ''; ?>>
                        Municipality</option> -->
                    <!-- <option value="City">City</option>
                    <option value="Municipality">Municipality</option> -->
                </select>
            </label>
        </div>
        <div class="field">
            <input 
                type="text" 
                class="input" 
                autocomplete="off" 
                id="cmdesc" 
                name="cmdesc" 
                placeholder=" " 
                required>
            <!-- value="<?= $cm['cmdesc'] ;?>" -->
            <label for="cmdesc" class="label">City/Municipality Description</label>
        </div>
        <div class="longlat">
            <div class="field input-latitude">
                <input 
                    type="number" 
                    step=".01" 
                    class="input" 
                    autocomplete="off" 
                    id="latitude" 
                    name="latitude" 
                    min="-90" 
                    max="90" 
                    placeholder=" " 
                    required>
                <label for="latitude" class="label">Latitude</label>
            </div>
            <div class="field input-longitude">
                <input 
                    type="number" 
                    step=".01" 
                    min="-180" 
                    max="180" 
                    class="input" 
                    autocomplete="off" 
                    id="longitude" 
                    name="longitude" 
                    placeholder=" " 
                    required>
                <label for="longitude" class="label">Longitude</label>
            </div>
        </div>
        <div class="field">
            <input 
                type="text" 
                class="input" 
                autocomplete="off" 
                id="remarks" 
                name="remarks" 
                placeholder=" ">
            <label for="remarks" class="label">Remarks</label>
        </div>

        <div class="buttons">
            <button type="submit" class="btn btn-lg btn-success" id="update" name="update">
                <i class="fas fa-save"></i>Update</button>
            <a type="button" class="btn btn-lg btn-primary" name="listing" href="/citymunicipality/listing">
                <i class="fas fa-list-ul"></i>Listing</a>
        </div>
    </form>
</main>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/citymun/citymun_edit.js"></script>
<?php } ?>