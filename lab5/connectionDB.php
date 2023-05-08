<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

//phpinfo();
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASSWORD = "";
const DB_DATABASE = "users";


function connect_to_db(){

    try {

        $dsn ='mysql:dbname=users;host=127.0.0.1;port=3306;';
        $db = new PDO($dsn, DB_USER, DB_PASSWORD);
        return $db;

    } catch (Exception $e){
        echo $e->getMessage();
    }
}

var_dump(connect_to_db());
?>