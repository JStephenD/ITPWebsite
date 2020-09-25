<main id="main" class="mapping-main pt-3 pl-5 pr-5 pb-3">
    <div class="mapping-controls">
        <div class="">
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
        <div class="">
            <select id="citymun_select">
                <option value="-1">
                    <- Not Available ->
                </option>
            </select>
        </div>
        <div class="">
            <select id="brgy_select">
                <option value="-1">
                    <- Not Available ->
                </option>
            </select>
        </div>
    </div>
    <div id="covidTraceMap"></div>
    </div>
</main>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/mapping/mapping_citymun.js"></script>
<?php } ?>