<?php
include_once 'templates/header.php';

$component_id = $_GET['components_id'];

$query = "SELECT * FROM components WHERE components.id =$component_id ";


$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$component_name = $row['name'];
$component_description = $row['description'];

mysqli_free_result($result);
?>
<header class="header">
    <div class="container">
        <div class="header_section">
            <h3><?php echo $component_name; ?></h3>
            <p><?php echo $component_description; ?></p>
        </div>
    </div>
</header>
<section class="">
    <div class="container">

        <div class="module_container">
            <!-- <div class="module_card">
                <div class="module_card-head">
                    <h4>module name</h4>
                </div>
                <div class="module_card-body">
                    <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis quibusdam repellendus, inventore dignissimos illum quisquam dolorem vitae aperiam quam cum facilis vel sapiente quaerat fugiat possimus ea similique earum ullam.</p>
                </div>
                <div class="module_card-footer">
                    <a href="module.php?module_id=2" class="">Learn Module</a>
                </div>
            </div> -->

            <?php
            $query = "SELECT * FROM modules WHERE component_id = $component_id";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }

            while ($row = mysqli_fetch_assoc($result)) {
                $module_id = $row['id'];
                $module_name = $row['name'];
                $module_description = $row['description'];
            ?>

                <div class="module_card">
                    <div class="module_card-head">
                        <h4><?php echo $module_name; ?></h4>
                    </div>
                    <div class="module_card-body">
                        <p class=""><?php echo $module_description; ?></p>
                    </div>
                    <div class="module_card-footer">
                        <a href="module.php?module_id=<?php echo $module_id; ?>" class="">Learn Module</a>
                    </div>
                </div>

            <?php
            }

            mysqli_free_result($result);
            ?>
        </div>
    </div>
</section>
<?php include_once 'templates/footer.php' ?>