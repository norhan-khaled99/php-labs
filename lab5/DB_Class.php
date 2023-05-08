<?php

class Database
{
    const DB_HOST = "localhost";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const DB_DATABASE = "users";

   static $pdo;

    // connection
    static function connect_to_db(){

        try {

            $dsn ='mysql:dbname=users;host=127.0.0.1;port=3306;';
            $db = new PDO($dsn, DB_USER, DB_PASSWORD);
            return $db;

        } catch (Exception $e){
            echo $e->getMessage();
        }
    }


    //insert
    function insert($name, $email, $password, $file_name, $file_tmp)
    {
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
                    echo "<a href='select.php' class='btn btn-primary'>Show All Users</a>";
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo "Error uploading file.";
        }
    }

    //select and draw the table
    public static function select($table)
    {
        $db = self::connect_to_db();
        if ($db) {
            $query = "select * from `users`";
            $select_stmt = $db->prepare($query);
            $res=$select_stmt->execute();
            $rows = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($rows) {
                echo "<p class='fs-1 fw-bold text-center '>Display all users</p>";
                echo "<table class='table  table-striped table-hover'> <tr class='text-center'><th>ID</th>  <th>Name</th>  <th>Email</th>
                 <th>image</th><th>Actions</th>
            </tr>";
                foreach ($rows as $row) {
                    echo "<tr class='text-center'>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td><img src='{$row['image']}' width='100' height='100'></td>"; // Display the image
                    echo "<td><a href='editform.php?id={$row['id']}' class='btn btn-warning mx-3'>Edit</a>";
                    echo "<a href='delete.php?id={$row['id']}' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
    }


    //update
    public static function update($name, $email, $password, $image_new_name, $id) {
        try {
            $db = connect_to_db();
            if ($db) {
                $query = "UPDATE `users`.`users` SET `name`=:name, `email`=:email, `password`=:password, `image`=:image WHERE `id`=:id";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                $stmt->bindParam(':image', $image_new_name, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $res = $stmt->execute();

                if ($stmt->rowCount()) {
                    echo "updated successfully";
                }
                echo "<a href='select.php' class='btn btn-primary'>Show All Users</a>";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //delete
    public static function delete($id)
    {
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
}