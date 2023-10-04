<?php
include_once 'templates/header.php';
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Fetch components
$sql = "SELECT * FROM components";
$result = $conn->query($sql);

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['edit_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $sub = $_POST['sub'];
    $name = $conn->real_escape_string($name);
    $description = $conn->real_escape_string($description);
    $sub = $conn->real_escape_string($sub);
    // Add component
    if (empty($id)) {
        $sql = "INSERT INTO components (name, description, sub) VALUES ('$name', '$description','$sub')";
        if ($conn->query($sql) === TRUE) {
            header("Location: dash_components.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else { // Edit component
        $sql = "UPDATE components SET name='$name', description='$description', sub='$sub' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    $sql = "SELECT * FROM components WHERE id=$edit_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $name = $row['name'];
        $description = $row['description'];
        $sub = $row['sub'];
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM components WHERE id=$delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

?>

<header class="">
    <div class="container">
        <div class="" style="margin-block: 2rem; ">
            <ul class="dash_menu">
                <ul class="dash_menu">
                    <li class=""><a href="dashboard.php" class="navbar_menu-btn navbar_menu-btn-default">Dashboard</a></li>
                    <li class=""><a href="dash_components.php" class="navbar_menu-btn navbar_menu-btn-default">Components</a></li>
                    <li class=""><a href="dash_quiz.php" class="navbar_menu-btn navbar_menu-btn-default">Quiz Response</a></li>
                </ul>
            </ul>
        </div>
    </div>
</header>

<section class="section">
    <div class="container">
        <div class="">
            <?php
            if (!isset($_GET['edit_id'])) {

                if ($result->num_rows > 0) {
                    echo "<h2>Components Table</h2>";
                    echo "<table class='table'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . $row['name'] . "</td>
                                    <td>" . $row['description'] . "</td>
                                    <td>
                                    <div class='btn_con'>
                                        <a class='navbar_menu-btn navbar_menu-btn-default' href='dash_components.php?edit_id=" . $row['id'] . "'>Edit</a> 
                                        <a class='navbar_menu-btn navbar_menu-btn-default' href='dash_modules.php?component_id=" . $row['id'] . "'>Modules</a> 
                                        <a class='navbar_menu-btn navbar_menu-btn-default' href='dash_components.php?delete_id=" . $row['id'] . "'>Delete</a>
                                    </div>
                                    </td>
                                </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No components found";
                }
            }
            ?>
        </div>
    </div>
</section>

<section class="section" style=" margin-block:2rem;">
    <div class="container">
        <div class="">
            <h2>Add/Edit Component</h2>
        </div>
        <div class="">
            <form action="" method="post">
                <div class="form_container">
                    <label for="name">Name:</label>
                    <input class="form_control" type="text" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>" required>
                </div>

                <div class="form_container">
                    <label for="description">Description:</label><br>
                    <textarea class="form_control" id="description" name="description" rows="4" cols="50"><?php echo isset($description) ? $description : ''; ?></textarea></br></br>
                </div>
                <div class="form_container">
                    <label for="sub">Sub Description:</label><br>
                    <textarea class="form_control" id="sub" name="sub" rows="4" cols="50"><?php echo isset($sub) ? $sub : ''; ?></textarea>
                </div>

                <?php if (isset($edit_id)) : ?>
                    <div class="form_container">
                        <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
                    </div>
                <?php endif; ?>

                <?php if (isset($edit_id)) : ?>
                    <button type="submit" class="navbar_menu-btn navbar_menu-btn-default" name="edit_component">Edit</button>
                <?php else : ?>
                    <button type="submit" class="navbar_menu-btn navbar_menu-btn-default" name="add_component">Submit</button>
                <?php endif; ?>

            </form>
        </div>
    </div>
</section>


<?php include_once 'templates/footer.php' ?>