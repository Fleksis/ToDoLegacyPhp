<?php
include '../includes/autoloader.php';
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../style.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <?php
    if (!empty($_POST)) {
        if(User::login($_POST['email'], $_POST['password'])) {
            $url = 'index.php';
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            header('Location: '. $url);
        }
    }
    ?>
    <div class="center-block">
        <form method="POST">
            <label for="email">Email</label><br>
            <input class="input" type="email" id="email" name="email" placeholder="Email" required><br>

            <label for="password">Password</label><br>
            <input class="input" type="password" id="password" name="password" placeholder="Password" required><br>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>