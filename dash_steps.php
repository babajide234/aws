<?php
include_once 'templates/header.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$result = [];

if (isset($_GET['module_id'])) {
    $module_id = $conn->real_escape_string($_GET['module_id']);
    $sql = "SELECT * FROM steps where module_id=$module_id";
    $result = $conn->query($sql);
}


if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    $sql = "SELECT * FROM steps WHERE id=$edit_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $name = $row['step_title'];
        $description = $row['step_description'];
        $number = $row['step_number'];
        $image = $row['image_path'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $image_path = '';
    $number = $conn->real_escape_string($_POST['number']);

    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $target_dir = "./uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        // ...
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            echo "Invalid file format. Please upload an image.";
        }

        if ($_FILES["image"]["size"] > 500000) {
            $uploadOk = 0;
            echo "Sorry, your file is too large.";
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Rename the file
                $random_string = uniqid(mt_rand(), true);
                $new_file_name = $target_dir . $random_string . "." . $imageFileType;

                if (rename($target_file, $new_file_name)) {
                    $image_path = $new_file_name;
                } else {
                    echo "Sorry, there was an error renaming the file.";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    if (!empty($_POST['edit_id'])) {
        $edit_id = $_POST['edit_id'];
        $img = $image_path ? $image_path : $image;
        $sql = "UPDATE steps SET step_title='$name', step_number='$number', step_description='$description', image_path='$img' WHERE id=$edit_id";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $module_id = $conn->real_escape_string($_GET['module_id']);
        $sql = "INSERT INTO steps ( module_id, step_number, step_title, step_description, image_path) VALUES ($module_id, $number, '$name', '$description', '$image_path')";
        if ($conn->query($sql) === TRUE) {
            echo "Record added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}



if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM steps WHERE id=$delete_id";
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
                    echo "<h2>Steps Table</h2>";
                    echo "<table class='table'>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td> <img src='" . $row['image_path'] . "' alt='' class='table_image' ></td>
                            <td>" . $row['step_title'] . "</td>
                            <td>
                                <div class='btn_con'>
                                    <a class='navbar_menu-btn navbar_menu-btn-default' href='dash_steps.php?edit_id=" . $row['id'] . "'>Edit</a> 
                                    <a class='navbar_menu-btn navbar_menu-btn-default' href='dash_steps.php?delete_id=" . $row['id'] . "'>Delete</a>
                                </div>
                            </td>
                          </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No steps found";
                }
            }
            ?>
        </div>
    </div>
</section>

<section class="section" style=" margin-block:2rem;">
    <div class="container">
        <div class="">
            <h2>Add/Edit Step</h2>
        </div>
        <div class="">
            <form action="" method="post" enctype="multipart/form-data">
                <div class=" form_container">
                    <label for="number">Step Number:</label>
                    <input class="form_control" type="number" id="number" name="number" value="<?php echo isset($number) ? $number : ''; ?>" required>
                </div>
                <div class="form_container">
                    <label for="name">Name:</label>
                    <input class="form_control" type="text" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>" required>
                </div>
                <div class="form_container">
                    <label for="description">Description:</label><br>
                    <textarea class="form_control" id="description" name="description" rows="4" cols="50"><?php echo isset($description) ? $description : ''; ?></textarea><br><br>
                </div>
                <div class="form_container">
                    <label for="image">Image:</label>
                    <input class="form_control" type="file" id="image" name="image" accept="image/*">

                </div>

                <?php if (isset($edit_id)) : ?>
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
                    <button type="submit" class="navbar_menu-btn navbar_menu-btn-default" name="edit_step">Edit</button>
                <?php else : ?>
                    <button type="submit" class="navbar_menu-btn navbar_menu-btn-default" name="add_step">Submit</button>
                <?php endif; ?>

            </form>
        </div>
    </div>
</section>

<?php include_once 'templates/footer.php' ?>