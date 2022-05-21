<?php
include '../includes/autoloader.php';
session_start();

$user = new User("Renārs", "Gausiņš", "Renārs2003@gmail.com", "Renar123");
//echo $user->LastName();
//echo $user->Email();

$stmt = (new Database)->get()->query("SELECT * FROM users");
$user = $stmt->fetchAll();

//$asda = $user[0]['email'];
//foreach ($user as $row) {
//    echo $row['firstname']."<br />\n";
//}

//error
$email = $_SESSION['email'];
$password = $_SESSION['password'];
echo $email;
echo $password;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo List</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="center-block navigation">
        <?php
            User::navigationBar();
        ?>
    </div>
    <div class="task-block">
        <div class="task-input">
            <form method="POST">
                <label for="title">ToDo Title</label><br>
                <input class="input" type="text" id="title" name="title" required><br>
                <label for="description">Description</label><br>
                <textarea maxlength="250" wrap="soft" id="description" name="description" required></textarea>
                <!--<input class="input" type="text" id="description" name="description"><br>-->
                <button type="submit">Submit</button>
            </form>
            <?php
                if(!empty($_POST)) {
                    $tasks = new Tasks($_POST['title'], $_POST['description']);
                    $tasks->save($_SESSION['email']);
                }
            ?>
        </div>
            <?php
                tasks::output($_SESSION['email']);
            ?>
        </div>
    </div>
</body>
</html>