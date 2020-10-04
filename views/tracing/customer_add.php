<main id="main" class="p-4">
    <form method="POST" id="customer-add-form">
        <legend>Add Customer Profile</legend>
        <font color="red">*</font> required
        <hr>

        <label for="" class="input-group-label">Customer Name</label>
        <div class="input-group">
            <label for="first-name" class="mx-2">First Name <font color="red">*</font></label>
            <input type="text" name="first-name" required id="first-name" autocomplete="off">

            <label for="last-name" class="mx-2">Last Name <font color="red">*</font></label>
            <input type="text" name="last-name" required id="last-name" autocomplete="off">
        </div>

        <label for="" class="input-group-label">Contact Information</label>
        <div class="input-group">
            <label for="phone-number" class="mx-2">Phone Number <font color="red">*</font></label>
            <input type="text" name="phone-number" required id="phone-number" autocomplete="off">

            <label for="email" class="mx-2">Email</label>
            <input type="email" name="email" id="email" autocomplete="off">
        </div>

        <label for="" class="input-group-label">Address</label>
        <div class="input-group">
            <label for="address" class="mx-2">City/Municipality</label>
            <select name="citymun-id" id="citymun">
                <option value="-1" selected disabled>Select City/Municipality</option>
            </select>

            <label for="barangay" class="mx-2">Barangay</label>
            <select name="barangay-id" id="barangay">
                <option value="-1" selected disabled>Select Barangay</option>
            </select>
        </div>

        <div class="buttons">
            <button type="submit" class="btn btn-lg btn-success mx-2" name="save" id="submit">
                <i class="fas fa-save"></i>Save</button>
            <a type="button" class="btn btn-lg btn-primary mx-2" name="listing" href="/tracing/logs/view">
                <i class="fas fa-list-ul"></i>View Logs</a>
            <a type="button" class="btn btn-lg btn-primary mx-2" name="listing" href="/tracing/customer">
                <i class="fas fa-pen-square"></i>Customer Logging</a>
        </div>
    </form>
</main>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/tracing/customer_add.js"></script>
<?php } ?>