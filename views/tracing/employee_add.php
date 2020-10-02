<main id="main" class="p-4">
    <form method="POST" id="employee-add-form" class="m-3">
        <div class="input-group">

        </div>

    </form>
</main>


<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/tracing/employee_add.js"></script>
<?php } ?>