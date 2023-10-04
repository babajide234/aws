<?php
include_once 'templates/header.php';
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>
<header class="">
    <div class="container">
        <div class="" style="margin-block: 2rem; ">
            <ul class="dash_menu">
                <li class=""><a href="dashboard.php" class="navbar_menu-btn navbar_menu-btn-default">Dashboard</a></li>
                <li class=""><a href="dash_components.php" class="navbar_menu-btn navbar_menu-btn-default">Components</a></li>
                <li class=""><a href="dash_modules.php" class="navbar_menu-btn navbar_menu-btn-default">Modules</a></li>
                <li class=""><a href="dash_quiz.php" class="navbar_menu-btn navbar_menu-btn-default">Quiz Response</a></li>
            </ul>
        </div>
    </div>
</header>
<section class="section">
    <div class="container">
        <div class="">
            <h2 class="">Dashboard</h2>
        </div>
    </div>
</section>
<?php include_once 'templates/footer.php' ?>