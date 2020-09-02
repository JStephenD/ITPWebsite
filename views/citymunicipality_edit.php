<div class="container-fluid">
    <form method="POST" class="form">
        <legend>Edit City / Municipality Information</legend>
        <span class="sep"></span>
        <div class="citymun">
            <select name="cmclass" class="select" required>
                <option 
                    value="City" 
                    <?= $cm['cmclass'] == 'city' ? 'selected' : '' ;?>>
                    City</option>
                <option 
                    value="Municipality" 
                    <?= $cm['cmclass'] == 'city' ? 'selected' : '' ;?>>
                    Municipality</option>
            </select>
            <img src="/assets/images/caret-square-up-solid.svg" alt="caret">
        </div>
        <div class="field">
            <input 
                type="text" class="input" autocomplete="off" name="cmdesc" 
                placeholder=" " required
                value="<?= $cm['cmdesc'] ;?>">
            <label for="cmdesc" class="label">City/Municipality Description</label>
        </div>
        <div class="longlat">
            <div class="field">
                <input type="number" step=".01" class="input" autocomplete="off" 
                name="latitude" min="-90" max="90" placeholder=" " required
                value="<?= $cm['latitude'] ;?>">
                <label for="latitude" class="label">Latitude</label>
            </div>
            <div class="field">
                <input type="number" step=".01" min="-180" max="180" class="input" 
                autocomplete="off" name="longitude" placeholder=" " required
                value="<?= $cm['longitude'] ;?>">
                <label for="longitude" class="label">Longitude</label>
            </div>
        </div>
        <div class="field">
            <input type="text" class="input" autocomplete="off" name="remarks" 
            placeholder=" " required
            value="<?= $cm['remarks'] ;?>">
            <label for="remarks" class="label">Remarks</label>
        </div>

        <div class="buttons">
            <button type="submit" class="btn btn-lg btn-success" name="update">
                <i class="fas fa-save"></i>Update</button>
            <a type="button" class="btn btn-lg btn-primary" name="listing" href="/citymunicipality/listing">
                <i class="fas fa-list-ul"></i>Listing</a>
        </div>
    </form>
</div>