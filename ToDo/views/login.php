<?php

include '../includes/autoloader.php';
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
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(    Validation::Validate($email, array("required", "isEmail", "isEmailExist"), emailValidateType: "login")
            && Validation::Validate($password, array("required", "isPasswordCorrect"), email: $email)
        ){
            echo "<div class='alert alert-green center-block'> <h3>You successfully logged in</h3> </div>";
        } else {
            echo "<div class='alert alert-red center-block'> <h3>Password is incorrect</h3> </div>";
        }
    }
    ?>
    <div class="center-block">
        <form method="POST">
            <label for="email">Email</label><br>
            <input class="input" type="email" id="email" name="email" placeholder="Email"><br>

            <label for="password">Password</label><br>
            <input class="input" type="password" id="password" name="password" placeholder="Password"><br>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>