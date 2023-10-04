<?php
include 'templates/header.php';
if (isset($_SESSION['email']) && $_SESSION['user_role'] == 'admin') {
    header("Location: dashboard.php");
    exit();
}
if (isset($_SESSION['email']) && $_SESSION['user_role'] == 'user') {
    header("Location: index.php");
    exit();
}
?>

<div class="auth">
    <div class="auth_left"></div>
    <div class="auth_right">
        <div class="auth_form">
            <form action="" id="loginForm">
                <h2>Login</h2>
                <div class="form_container">
                    <label for="email">Email:</label>
                    <input class="form_control" type="email" name="email" id="email" required>
                </div>
                <div class="form_container">
                    <label for="password">Password:</label>
                    <input class="form_control" type="password" name="password" id="password" required>
                </div>
                <button type="submit" class="navbar_menu-btn navbar_menu-btn-default">Submit</button>
                <a href="index.php" class="navbar_menu-btn navbar_menu-btn-outline">Back to Home</a>
                <p class=""> If not Registered ?. <a href="register.php" class=" text-success text-bold">Register</a></p>
            </form>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>