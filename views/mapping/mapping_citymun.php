<main id="main" class="mapping-main mt-5 pl-5 pr-5 pb-3">
    <div class="mapping-controls">
        <div class="mapping-controls-select">
            <label for="city_or_mun_select">
                Choose from the options.
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
            </label>
        </div>
        <div class="mapping-controls-select">
            <label for="citymun_select">
                Choose City/Municipality
                <select id="citymun_select">
                    <option value="-1">
                        <- Not Available ->
                    </option>
                </select>
            </label>
        </div>
        <div class="mapping-controls-select">
            <label for="brgy_select">
                Choose Barangay
                <select id="brgy_select">
                    <option value="-1">
                        <- Not Available ->
                    </option>
                </select>
            </label>
        </div>
    </div>
    <div id="covidTraceMap"></div>
</main>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/mapping/mapping_citymun.js"></script>
<?php } ?>