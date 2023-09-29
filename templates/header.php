<?php
session_start();
include('includes/db.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <?php if ($_SERVER['REQUEST_URI'] !== "/aws/register.php") : ?>

        <nav class="navbar">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="navbar_menu">
                        <ul class="">
                            <li class="navbar_menu-item"><a href="index.php" class="navbar_menu-link">Home</a></li>
                        </ul>
                        <ul class="d-flex">
                            <?php if (isset($_SESSION['email'])) : ?>
                                <li class="navbar_menu-item"><a href="dashboard.php" class="navbar_menu-btn navbar_menu-btn-default">Dashboard</a></li>
                                <li class="navbar_menu-item"><a href="logout.php" class="navbar_menu-btn navbar_menu-btn-outline">Logout</a></li>
                            <?php else : ?>
                                <li class="navbar_menu-item"><a href="login.php" class="navbar_menu-btn navbar_menu-btn-default">Login</a></li>
                                <li class="navbar_menu-item"><a href="register.php" class="navbar_menu-btn navbar_menu-btn-outline">Register</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

    <?php endif ?>