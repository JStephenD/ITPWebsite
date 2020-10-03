<main id="main" class="p-4">
    <table id="logs-view">
        <thead>
            <tr>
                <th scope="col">Entry Type</th>
                <th scope="col">Profile</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Temp</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log) { ?>
                <tr>
                    <td><?= ($log['entry_type'] == 1) ?
                            'Employee' :
                            'Customer' ?></td>
                    <td><?= ($log['entry_type'] == 1) ?
                            name($employees, $log['profile_id']) :
                            name($customers, $log['profile_id']) ?></td>
                    <td><?= $log['date']; ?></td>
                    <td><?= $log['time']; ?></td>
                    <td><?= $log['temp']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src='/assets/js/tracing/logs_view.js'></script>
<?php } ?>