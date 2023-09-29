<div class="container">

    <div class="dashbar">
        <ul class="dashbar_menu">
            <li class="dashbar_menu_item"><a href="index.php?page=dashboard&child_route=dashboard" class="dashbar_menu_link">Dashboard</a></li>
            <li class="dashbar_menu_item"><a href="index.php?child_route=learning_modules" class="dashbar_menu_link">Learning Modules</a></li>
        </ul>
    </div>

    <div class="dashboard_content">
        <div class="dashboard_header">
            <h2>Dashboard</h2>
        </div>
        <?php
        $route = isset($_GET['child_route']) ? $_GET['child_route'] : 'dashboard';
        switch ($route) {
            case 'dashboard':
                include_once '../templates/dashboard.php';
                break;

            case 'learning_modules':
                include_once '../templates/learning_modules.php';
                break;

                // Add more cases for other child routes as needed

            default:
                include_once 'dashboard.php';
                break;
        }

        ?>

    </div>
</div>