<div class="container">
    <main>
        <form method="POST" class="account-form" enctype="multipart/form-data">
            <div class="field">
                <input 
                    type="text" 
                    name="first-name" 
                    class="input" 
                    placeholder=" "
                    value="<?= $first_name ;?>"
                    autocomplete="off">
                <label for="first-name" class="label">First Name</label>
            </div>

            <div class="field">
                <input 
                    type="text" 
                    name="last-name" 
                    class="input" 
                    placeholder=" "
                    value="<?= $last_name ;?>"
                    autocomplete="off">
                <label for="last-name" class="label">Last Name</label>
            </div>

            <div class="field">
                <input 
                    type="date" 
                    class="date"
                    name="birthday"
                    placeholder=" "
                    value="<?= $birthday ;?>">
                <label for="last-name" class="label">Birthday dd/mm/year</label>
            </div>

            <button class="login_button" name="update">Update</button>
        </form>
    </main>
</div>