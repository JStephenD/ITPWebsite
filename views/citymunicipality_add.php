<div class="container-fluid">
    <form method="POST" class="form">
        <legend>City / Municipality Form</legend>
        <span class="sep"></span>
        <div class="citymun">
            <select name="cmclass" class="select" required>
                <option disabled selected>Select Classification</option>
                <option value="City">City</option>
                <option value="Municipality">Municipality</option>
            </select>
            <img src="/assets/images/caret-square-up-solid.svg" alt="caret">
        </div>
        <div class="field">
            <input type="text" class="input" autocomplete="off" name="cmdesc" placeholder=" " required>
            <label for="cmdesc" class="label">City/Municipality Description</label>
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
            <button type="submit" class="btn btn-lg btn-success" name="save">
                <i class="fas fa-save"></i>Save</button>
            <a type="button" class="btn btn-lg btn-primary" name="listing" href="/citymunicipality/listing">
                <i class="fas fa-list-ul"></i>Listing</a>
        </div>
    </form>
</div>