<main id="main" class="p-4">
    <form method="POST" id="employee-log-form" class="m-3">
        <legend>Employee Daily Logging</legend>
        <hr>
        <div class="input-group">
            <label for="employee-id" class="mr-2">
                Employee Name
            </label>

            <select name="employee-id" id="employee-id" class="p-2">
                <option value="-1" disabled selected>Select Employee</option>
                <?php foreach ($employees as $row) { ?>
                    <option value="<?= $row['id']; ?>">
                        <?= $row['last_name'] . ', ' . $row['first_name']; ?>
                    </option>
                <?php } ?>
            </select>

            <small class="ml-5"><em>Name not found?</em></small>
            <button id="add-employee" class="btn btn-outline-dark ml-2">
                ➕ Add profile</button>
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
    <script defer="defer" src="/assets/js/tracing/employee_log.js"></script>
<?php } ?>