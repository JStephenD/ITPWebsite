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
            <button href="/tracing/employee/add" id="add-employee" class="btn btn-outline-dark ml-2">
                ➕ Add profile</button>
        </div>

        <div class="input-group">
            <label for="date">
                Date
            </label>

            <input type="text" id="date">

            <label for="time">
                Time
            </label>

            <input type="text" id="time">
        </div>

    </form>
</main>


<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/tracing/employee_log.js"></script>
<?php } ?>