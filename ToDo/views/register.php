<?php
include '../includes/autoloader.php';
session_unset();
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style.css">
    <title>Register</title>
</head>
<body>
    <?php
        if(!empty($_POST)) {
            $newUser = new User($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_POST['password_confirmation']);

            if($newUser->register()) {
                header('Location: '. 'login.php');
                echo "<div class='alert alert-green center-block'> <h3>New user is registered</h3> </div>";
            }
        }
    ?>
    <div class="center-block">
        <form method="POST">
            <label for="firstname">Firstname</label><br>
            <input class="input" type="text" id="firstname" name="firstname" placeholder="First name" required><br>
            <label for="lastname">Lastname</label><br>
            <input class="input" type="text" id="lastname" name="lastname" placeholder="Last name" required><br>
            <label for="email">Email</label><br>
            <input class="input" type="email" id="email" name="email" placeholder="Email" required><br>
            <label for="password">Password</label><br>
            <input class="input" type="password" id="password" name="password" placeholder="Password" required><br>
            <label for="password_confirmation">Repeat password</label><br>
            <input class="input" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required><br>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>