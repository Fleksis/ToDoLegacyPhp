<?php
$errors = [];
use App\Models\Validation;
use App\Models\User;
require_once 'database/db.php';

spl_autoload_register(function($class){
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

$user = new User("Renārs", "Gausiņš", "Renārs2003@gmail.com", "Renar123");
echo $user->FirstName();
echo $user->LastName();
echo $user->Email();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="ToDo-Window">
        <div class="ToDo-Form">
            <form method="POST">
                <label for="title">ToDo Title</label><br>
                <input type="text" id="title" name="title"><br>
                <label for="description">Description</label><br>
                <input type="text" id="description" name="description">
                <button type="submit">Submit</button>
            </form>
        </div>
        <div class="ToDo-List">
            <?php
                if (!empty($_POST)) {
                    $errors[] = "ideals";
                }
            ?>
        </div>
        <?php
        foreach ($errors as $error) {
            echo $error;
        }
        ?>
    </div>

</body>
</html>