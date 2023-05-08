<?php
include 'connectionDB.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

if (isset($_GET['id'])) {
    $id=$_GET['id'];
    try {
        $db=Database::connect_to_db();
        if ($db) {
            $query="select * from users where id=:id";
            $stmt=$db->prepare($query);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $res=$stmt->execute();
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
else
{
    exit();
}

?>


<p class="fs-1 text-center fst-italic">Edit user <?php echo $row['name']?></p>
<form action="update.php?id=<?php echo $row['id']?>" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="flex-column d-flex justify-content-center align-items-center">
            <div class="form-group ">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
                value="<?php echo $row['name'];?>">
            </div>
            <div class="form-group my-3">

                <label for="email">email:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your mail"
                       value="<?php echo $row['email'];?>">

            </div>

            <div class="form-group my-3">
                <label for="password">password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>

            <div class="form-group my-3">
                <label for="confirm password">confirm password</label>
                <input type="password" class="form-control" name="confirm password" id="confirm password" >
            </div>

            <div class="form-group my-3">
                <label for="room num">room number</label>
                <select class="form-control" name="room num" id="room num"  value="<?php echo $row['room num'];?>>
                    <option value="">Select a Room number</option>
                    <option value="App 1">App 1</option>
                    <option value="App 2">App 2</option>
                    <option value="cloud">cloud</option>
                </select>
            </div>

            <div class="form-group my-3">
                <label for="image"></label>
                <input type="file" class="form-control" name="image" id="picture  accept="image/*" value="<?php echo $row['image'];?>>
            </div>

            <button type="submit" class="btn btn-primary my-2" name="submit">Submit</button>
        </div>
    </div>
</form>


<p class="fs-1 text-center fst-italic">Edit user <?php echo $row['name']?></p>
<form action="update.php?id=<?php echo $row['id']?>" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="flex-column d-flex justify-content-center align-items-center">
            <div class="form-group ">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
                       value="<?php echo $row['name'];?>"
                >
            </div>
            <div class="form-group my-3">
                <label for="email">email:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your mail"
                       value="<?php echo $row['email'];?>">
            </div>
            <div class="form-group my-3">
                <label for="password">password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="form-group my-3">
                <label for="confirm password">confirm password</label>
                <input type="password" class="form-control" name="confirm password" id="confirm password">
            </div>
            <div class="form-group my-3">
                <label for="room num">room number</label>
                <select class="form-control" name="room num" id="room num">
                    <option value="">Select a Room number</option>
                    <option value="App 1" <?php if ($row['room num'] == 'App 1') echo 'selected'; ?>>App 1</option>
                    <option value="App 2" <?php if ($row['room num'] == 'App 2') echo 'selected'; ?>>App 2</option>
                    <option value="cloud" echo 'selected'; ?>>cloud</option>
                </select>
            </div>
            <div class="form-group my-3">
                <label for="image"></label>
                <input type="file" class="form-control" name="image" id="picture" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary my-2" name="submit">Submit</button>
        </div>
    </div>
</form>
