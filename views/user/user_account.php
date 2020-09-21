<div class="container">
    <main>
        <form method="POST" id="form-update" class="account-form" enctype="multipart/form-data">
            <div class="field">
                <input type="text" name="first-name" class="input" placeholder=" " value="<?= $first_name; ?>" autocomplete="off">
                <label for="first-name" class="label">First Name</label>
            </div>

            <div class="field">
                <input type="text" name="last-name" class="input" placeholder=" " value="<?= $last_name; ?>" autocomplete="off">
                <label for="last-name" class="label">Last Name</label>
            </div>

            <div class="field">
                <input type="date" class="date" name="birthday" placeholder=" " value="<?= $birthday; ?>">
                <label for="last-name" class="label">Birthday dd/mm/year</label>
            </div>

            <div class="field">
                <img src="<?= '../' . $dp_url; ?>" alt="dp image" id="showImg" class="dp_img">
                <input type="file" name="dp" id="rFile" accept="image/*" hidden>
                <button type="button" id="fBtn">Update Display Picture</button>
            </div>

            <button class="login_button" name="update" id="update">Update</button>
        </form>
    </main>
</div>

<script>
    uid = <?= $id ;?>
</script>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/user/account.js"></script>
<?php } ?>