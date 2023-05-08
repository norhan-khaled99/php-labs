<?php
include 'connectionDB.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
try {
    $db=connect_to_db();
    if($db){

        $query = "select * from `users`";
        $select_stmt = $db->prepare($query);
        $res=$select_stmt->execute();
        $data = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<p class='fs-1 fw-bold text-center '>Display all users</p>";
        echo "<table class='table  table-striped table-hover'> <tr class='text-center'><th>ID</th>  <th>Name</th>  <th>Email</th>
         <th>image</th><th>Actions</th>
        </tr>";

        foreach ($data as $row) {
            echo "<tr class='text-center'>";
            echo "<td >{$row['id']}</td>";
            echo "<td >{$row['name']}</td>";
            echo "<td >{$row['email']}</td>";
            echo "<td ><img src='{$row['image']}' width='100' height='100'></td>"; // Display the image
            echo "<td ><a href='editform.php?id={$row['id']}' class='btn btn-warning mx-3'>Edit</a>";
            echo "<a href='delete.php?id={$row['id']}' class='btn btn-danger'>Delete</a></td>";
            echo "</tr>";
        }

        echo "</table>";


    }

}catch (Exception $e) {
    echo $e->getMessage();
}

echo "<div class='d-flex justify-content-center my-3'>";
echo "<a href='index.php'><button class='btn btn-primary'>Add new user</button></a>";
echo "</div>";
?>