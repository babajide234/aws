<?php
include_once 'templates/header.php';
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
?>

<section class="section">
    <div class="container">
        <div class="learning_container">
            <div id="moduleSteps">

            </div>
            <div class="learning_btn">
                <button id="prev-btn" class="">previous </button>
                <button id="next-btn" class="">next</button>
            </div>
        </div>
    </div>
</section>
<?php include_once 'templates/footer.php' ?>