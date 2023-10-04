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
$sub_description = $row['sub'];

mysqli_free_result($result);
?>
<header class="header">
    <div class="container">
        <div class="header_section">
            <div class="bg-secondary header_section_sub">
                <h3 class="text-bg"><?php echo $component_name; ?></h3>
                <p class="text-bg "><?php echo $component_description; ?></p>
            </div>
        </div>
    </div>
</header>
<section class="">
    <div class="container">
        <div class="section_full">
            <?= $sub_description ?>
        </div>
    </div>
</section>
<section class="">
    <div class="container">

        <div class="module_container">
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
            <div class="module_card">
                <div class="module_card-head">
                    <h4>Quiz</h4>
                </div>
                <div class="module_card-body">
                    <p class=""></p>
                </div>
                <div class="module_card-footer">
                    <a href="quiz.php" class="">Take a Quiz</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once 'templates/footer.php' ?>