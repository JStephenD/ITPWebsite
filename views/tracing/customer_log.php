<main id="main" class="p-4">
    <form method="POST" id="customer-log-form" class="m-3">
        <legend>Customer Daily Logging</legend>
        <hr>
        <div class="input-group">
            <label for="customer-id" class="mr-2">Customer Name</label>
            <select name="customer-id" id="customer-id" class="p-2">
                <option value="-1" disabled selected>Select Customer</option>
                <?php foreach ($customers as $row) { ?>
                    <option value="<?= $row['id']; ?>">
                        <?= $row['last_name'] . ', ' . $row['first_name']; ?>
                    </option>
                <?php } ?>
            </select>

            <small class="ml-5"><em>Name not found?</em></small>
            <a type="button" id="add-profile" href="/tracing/customer/add" class="btn btn-small btn-outline-dark ml-2">
                ➕ Add profile</a>
        </div>

        <div class="input-group">
            <label for="date">
                Date
            </label>

            <input type="text" name="date" id="date" class="mx-2">

            <label for="time">
                Time
            </label>

            <input type="text" name="time" id="time" class="mx-2">
            <button type="button" id="set-current-time" class="btn btn-small">Set current time</button>
        </div>

        <div class="input-group">
            <label for="temp">
                Temperature
            </label>

            <input type="number" name="temp" id="temp" value="0" class="ml-2">
        </div>

        <div class="buttons">
            <button type="submit" class="btn btn-lg btn-success mr-2" name="save" id="submit">
                <i class="fas fa-save"></i>Save</button>
            <a type="button" class="btn btn-lg btn-primary ml-2" name="listing" href="/tracing/logs/view">
                <i class="fas fa-list-ul"></i>View Logs</a>
        </div>
    </form>
</main>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/tracing/customer_log.js"></script>
<?php } ?>