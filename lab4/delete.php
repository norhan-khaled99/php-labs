<?php
//include 'connectionDB.php';
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//
//echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
//<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
//
//if (isset($_GET['id'])) {
//    $id=$_GET['id'];
//    try {
//        $db = connect_to_db();
//        if ($db) {
//            $query="delete from users where id=:id";
//            $stmt=$db->prepare($query);
//            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
//            $res=$stmt->execute();
//            $row=$stmt->fetch(PDO::FETCH_ASSOC);
//
//        }
//
//    } catch (Exception $e) {
//        echo $e->getMessage();
//    }
//
//}
//else
//{
//    exit();
//}
//
//?>
<!--<button class="btn btn-light"><a href="select.php" style="text-decoration: none;">Display All Users</a></button>-->

<?php
include 'connectionDB.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

function delete_user($id) {
    try {
        $db = connect_to_db();
        if ($db) {
            $query = "DELETE FROM users WHERE id=:id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $res = $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    delete_user($id);
} else {
    exit();
}
?>

<button class="btn btn-light"><a href="select.php" style="text-decoration: none;">Display All Users</a></button>
