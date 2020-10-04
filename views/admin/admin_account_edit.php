<main id="main" class="p-4">
    <form method="POST" id="admin-account-edit-form">
        <legend><strong><?= $user['username']; ?></strong> Permissions Edit Form</legend>

        <div class="perms-group-wrapper">
            <div class="perms-group">
                <strong>Admin Module</strong>

                <div class="check-group">
                    <input type="checkbox" name="perms[]" value="admin" id="admin" <?= checked($perms, 'admin'); ?>>
                    <label for="admin">admin</label>
                </div>
            </div>
            <div class="perms-group">
                <strong>CityMun Module</strong>

                <div class="check-group">
                    <input type="checkbox" name="perms[]" value="citymun_listing" id="citymun-listing" <?= checked($perms, 'citymun_listing'); ?>>
                    <label for="citymun-listing">citymun_listing</label>
                </div>
                <div class="check-group">
                    <input type="checkbox" name="perms[]" value="citymun_add" id="citymun-add" <?= checked($perms, 'citymun_add'); ?>>
                    <label for="citymun-add">citymun_add</label>
                </div>
                <div class="check-group">
                    <input type="checkbox" name="perms[]" value="citymun_edit" id="citymun-edit" <?= checked($perms, 'citymun_edit'); ?>>
                    <label for="citymun-edit">citymun_edit</label>
                </div>
                <div class="check-group">
                    <input type="checkbox" name="perms[]" value="citymun_delete" id="citymun-delete" <?= checked($perms, 'citymun_delete'); ?>>
                    <label for="citymun-delete">citymun-delete</label>
                </div>
            </div>
            <div class="perms-group">
                <strong>Barangay Module</strong>

                <div class="check-group">
                    <input type="checkbox" name="perms[]" value="brgy_listing" id="brgy-listing" <?= checked($perms, 'brgy_listing'); ?>>
                    <label for="brgy-listing">brgy_listing</label>
                </div>
                <div class="check-group">
                    <input type="checkbox" name="perms[]" value="brgy_add" id="brgy-add" <?= checked($perms, 'brgy_add'); ?>>
                    <label for="brgy-add">brgy_add</label>
                </div>
                <div class="check-group">
                    <input type="checkbox" name="perms[]" value="brgy_edit" id="brgy-edit" <?= checked($perms, 'brgy_edit'); ?>>
                    <label for="brgy-edit">brgy_edit</label>
                </div>
                <div class="check-group">
                    <input type="checkbox" name="perms[]" value="brgy_delete" id="brgy-delete" <?= checked($perms, 'brgy_delete'); ?>>
                    <label for="brgy-delete">brgy_delete</label>
                </div>
            </div>
        </div>
        <div class="perms-group-wrapper">
            <div class="perms-group">
                <strong>Mapping Module</strong>

                <div class="check-group">
                    <input type="checkbox" name="perms[]" value="mapping_citymun" id="mapping-citymun" <?= checked($perms, 'mapping_citymun'); ?>>
                    <label for="mapping-citymun">mapping_citymun</label>
                </div>
            </div>
            <div class="perms-group">
                <strong>User Module</strong>

                <div class="check-group">
                    <input type="checkbox" name="perms[]" value="user_account" id="user-account" <?= checked($perms, 'user_account'); ?>>
                    <label for="user-account">user_account</label>
                </div>
            </div>
            <div class="perms-group">
                <strong>Logging Module</strong>

                <div class="check-group">
                    <input type="checkbox" name="perms[]" value="logging_view" id="logging-view" <?= checked($perms, 'logging_view'); ?>>
                    <label for="loggin-view">logging_view</label>
                </div>
                <div class="check-group">
                    <input type="checkbox" name="perms[]" value="logging_employee_log" id="logging-employee-log" <?= checked($perms, 'logging_employee_log'); ?>>
                    <label for="logging-employee-log">logging_employee_log</label>
                </div>
                <div class="check-group">
                    <input type="checkbox" name="perms[]" value="logging_customer_log" id="logging-customer-log" <?= checked($perms, 'logging_customer_log'); ?>>
                    <label for="logging-customer-log">logging_customer_log</label>
                </div>
                <div class="check-group">
                    <input type="checkbox" name="perms[]" value="logging_edit" id="logging-edit" <?= checked($perms, 'logging_edit'); ?>>
                    <label for="loggin-edit">logging_edit</label>
                </div>
            </div>
        </div>

        <div class="buttons">
            <button type="submit" class="btn btn-lg btn-success" name="save" id="submit">
                <i class="fas fa-save"></i>Update</button>
            <a type="button" class="btn btn-lg btn-primary" name="listing" href="/admin/accounts">
                <i class="fas fa-list-ul"></i>Accounts</a>
        </div>
    </form>
</main>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/admin/admin_account_edit.js"></script>
<?php } ?>