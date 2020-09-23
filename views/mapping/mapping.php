<main id="main" class="mapping-main p-5">
    <div class="mapping-controls">
        <div class="citymun">
            <select id="city_or_mun_select">
                <option value="all">
                    <- Show ALL ->
                </option>
                <option value="city">
                    <- Show Cities ->
                </option>
                <option value="mun">
                    <- Show Municipalities ->
                </option>
            </select>
        </div>
        <div class="brgy">
            <select id="brgy_select">
                <option value="-1">
                    <- Not Available ->
                </option>
            </select>
        </div>
    </div>
    <div id="covidTraceMap"></div>
    <div class="mapping-options">
        <div class="option">
            <input type="checkbox" name="cms" id="cms" checked>
            <label for="cms">Toggle City/Municipalities Label</label>
        </div>
        <div class="option">
            <input type="checkbox" name="brgs" id="brgs" checked>
            <label for="brgs">Toggle Barangay Labels</label>
        </div>
        <div class="option">
            <input type="checkbox" name="urhere" id="urhere" checked>
            <label for="urhere">Toggle Ip Location Label</label>
        </div>
    </div>
    </div>

    <?php if (!isset($_POST['ajax'])) { ?>
        <script defer="defer" src="/assets/js/mapping/mapping.js"></script>
    <?php } ?>