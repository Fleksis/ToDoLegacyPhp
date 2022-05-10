<?php
if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
}
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
    <form method="POST">
        <form method="POST">
            <label for="email"></label><br>
            <input type="email" id="email" name="email" >

            <label for="password"></label><br>
            <input type="password" id="password" name="password">

            <button type="submit">Submit</button>
        </form>
    </form>
</body>
</html>