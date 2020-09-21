<div class="mapping-main">
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