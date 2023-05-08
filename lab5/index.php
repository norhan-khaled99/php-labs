<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';


if(isset($_GET["errors"])){
    $errors = json_decode($_GET["errors"], true);
}
if(isset($_GET["old"])){
    $old_data = json_decode($_GET["old"], true);
}
?>
<html>
<head>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="select.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Manuual order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Checks</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<p class="fs-1 text-center fst-italic">Add user</p>
<form action="insert.php" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="flex-column d-flex justify-content-center align-items-center">
            <div class="form-group ">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="<?php if(isset($old_data['name'])) echo $old_data['name'];?>">
                <span class="text-danger"> <?php if(isset($errors['name'])) echo $errors['name']; ?> </span>

            </div>
            <div class="form-group my-3">

                <label for="email">email:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your mail"
                       value="<?php if(isset($old_data['email'])) echo $old_data['email']; ?>">
                <span class="text-danger"> <?php if(isset($errors['email'])) echo $errors['email']; ?> </span>
            </div>

            <div class="form-group my-3">
                <label for="password">password</label>
                <input type="password" class="form-control" name="password" id="password"
                       value="<?php if(isset($old_data['password'])) echo $old_data['password']; ?>">
                <span class="text-danger"> <?php if(isset($errors['password'])) echo $errors['password']; ?> </span>
            </div>


            <div class="form-group my-3">
                <label for="room num">room number</label>
                <select class="form-control" name="room_num" id="room num" >
                    <option disabled selected>Select a Room number</option>
                    <option <?php if(isset($old_data['room_num']) and $old_data['room_num']=='App 1') echo "selected"; ?>>App 1</option>
                    <option <?php if(isset($old_data['room_num']) and $old_data['room_num']=='App 2') echo "selected"; ?>>App 2</option>
                    <option <?php if(isset($old_data['room_num']) and $old_data['room_num']=='cloud') echo "selected"; ?>>cloud</option>
                </select>
                <span class="text-danger"> <?php if(isset($errors['room_num'])) echo $errors['room_num']; ?> </span>
            </div>


            <div class="form-group my-3">
                <label for="image"></label>
                <input type="file" class="form-control" name="image" id="picture  accept="image/*" >
                <span class="text-danger text-center"> <?php if(isset($errors['image'])) echo $errors['image']; ?> </span>
            </div>
            <button type="submit" class="btn btn-primary my-2" name="submit">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>

        </div>
</form>

</body>
</html>
