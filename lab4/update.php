<?php
include 'connectionDB.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';


$name=$_POST["name"];
$email = $_POST["email"];
$password=$_POST["password"];
$id=$_GET["id"];


$image_new_name = '';
$imagename = $_FILES["image"]['name'];
$tmp_name = $_FILES['image']['tmp_name'];
$ext = pathinfo($imagename)['extension'];
$image_new_name = "uploads/{$id}.{$ext}";
try {
    $uploaded = move_uploaded_file($tmp_name, "$image_new_name");
} catch (Exception $e) {
    var_dump($e->getMessage());
    exit;
}
try {
    $db=connect_to_db();
    if($db){
        $query="UPDATE `users`.`users` SET `name`=:name, `email`=:email, `password`=:password, `image`=:image WHERE `id`=:id";
        $stmt=$db->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image_new_name, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $res = $stmt->execute();

        if ($stmt->rowCount()) {
            echo "updated successufully";
        }
        echo "<a href='select.php' class='btn btn-primary'>Show All Users</a>";
    }


}catch (Exception $e) {
    echo $e->getMessage();
}

?>