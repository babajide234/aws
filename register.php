<?php include '../templates/header.php'; ?>

<div class="auth">
    <div class="auth_left"></div>
    <div class="auth_right">
        <div class="auth_form">
            <form action="" id="registerForm">
                <h2>Register</h2>
                <div class="form_container">
                    <label for="fullName">Full Name:</label>
                    <input class="form_control" type="text" id="fullName" name="fullName" required>
                </div>
                <div class="form_container">
                    <label for="fullName">UserName:</label>
                    <input class="form_control" type="text" id="userName" name="userName" required>
                </div>
                <div class="form_container">
                    <label for="email">Email:</label>
                    <input class="form_control" type="email" id="email" name="email" required>
                </div>
                <div class="form_container">
                    <label for="password">Password:</label>
                    <input class="form_control" type="password" id="password" name="password" required>
                </div>
                <div class="form_container">
                    <label for="password">Confirm Password:</label>
                    <input class="form_control" type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="navbar_menu-btn navbar_menu-btn-default">Submit</button>
                <p class=""> Already Registered ?. <a href="index.php?page=login" class=" text-success text-bold">Login</a></p>
            </form>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>