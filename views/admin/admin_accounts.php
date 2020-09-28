<main id="main" class="p-4">
    <table id="admin_accounts" class="hover row-borders">
        <thead>
            <tr>
                <th scope="col">Display Image</th>
                <th scope="col">Username</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Birthday</th>
                <th scope="col">Perms</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $row) { ?>
                <tr>
                    <td class="admin_accounts_dp_row" scope="row"><img class="admin_accounts_dp_image" src="<?= '/' . $row['dp_url']; ?>" alt="Display Image"></td>
                    <td scope="row"><?= $row['username']; ?></td>
                    <td><?= $row['first_name']; ?></td>
                    <td><?= $row['last_name']; ?></td>
                    <td><?= $row['birthday']; ?></td>
                    <td><?= $row['perms']; ?></td>
                    <td class='action'>
                        <abbr title="Edit">
                            <a class="link-unstyled" href="/admin/account/edit/<?= $row['id']; ?>">
                                <i class="fas fa-edit table-edit abbr-edit"></i>
                            </a>
                        </abbr>
                        <abbr title="Delete">
                            <i data-href="/admin/accounts/delete/<?= $row['id']; ?>" data-name="<?= $row['username']; ?>" class="fas fa-backspace table-delete abbr-delete">
                            </i>
                        </abbr>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/admin/admin_accounts.js"></script>
<?php } ?>