<div class="mapping-main">
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
            <select id="citymun_select">
                <option value="-1">
                    <- Not Available ->
                </option>
            </select>
        </div>
    </div>
    <div id="covidTraceMap"></div>
</div>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/mapping/mapping_citymun.js"></script>
<?php } ?>