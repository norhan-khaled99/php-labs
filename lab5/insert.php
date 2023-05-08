<?php
include 'connectionDB.php';
include 'DB_Class.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

$errors = [];
$formdata = [];
if (empty($_POST["email"]) and isset($_POST["email"])) {
    $errors['email'] = 'email required';
}
else {
    $formdata["email"] = $_POST["email"];
}
if (empty($_POST["password"]) and isset($_POST["password"])) {
    $errors['password'] = 'password required';
}
else {
    $formdata["password"] = $_POST["password"];
}
if (empty($_POST["room_num"]) and isset($_POST["room_num"])) {

    $errors['room_num'] = 'room_num required';
}
else if(!isset($_POST["room_num"]))
{
    $errors['room_num'] = 'please enter room number';
}
else {
    $formdata["room_num"] = $_POST["room_num"];
}
if (empty($_POST["name"]) and isset($_POST["name"])) {

    $errors['name'] = 'please enter your name ';
} else {
    $formdata["name"] = $_POST["name"];
}
if(isset($_FILES['image']) and empty($_FILES['image']['name'])) {
    $errors['image'] = 'please upload image required';
}

if ($errors) {
    $errors_str = json_encode($errors);
    $url = "Location:index.php?errors={$errors_str}";

    if ($formdata) {
        $old_data = json_encode($formdata);
        $url .= "&old={$old_data}";
    }
    header($url);
}else {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

// Check if image file is uploaded
    if ($_FILES["image"]["error"] == 0) {
        // Get file details
        $file_name = $_FILES["image"]["name"];
        $file_tmp = $_FILES["image"]["tmp_name"];
        $file_type = $_FILES["image"]["type"];
        $file_size = $_FILES["image"]["size"];

        // Move uploaded file to desired location
        $target_dir = "uploads/"; // Change this to your desired directory
        $target_file = $target_dir . $file_name;
        if (move_uploaded_file($file_tmp, $target_file)) {
            try {
                $db = connect_to_db();
                if ($db) {
                    $query = "INSERT INTO `users` (name, email, password, image) VALUES (?, ?, ?, ?)";
                    $stmt = $db->prepare($query);
                    $stmt->execute([$name, $email, $password, $target_file]);
                    $res = $stmt->rowCount();
                    $id = $db->lastInsertId();
                }
                echo "<a href='select.php' class='btn btn-primary'>Show All Users</a>";
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo "Error uploading file.";
        }
    }
}
?>
