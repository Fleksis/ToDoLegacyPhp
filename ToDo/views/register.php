<?php

include '../includes/autoloader.php';

if(!empty($_POST)) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirmation = $_POST['password_confirmation'];

    if (   Validation::Validate($firstname, array("required"))
        && Validation::Validate($lastname, array("require"))
        && Validation::Validate($email, array("required", "isEmail", "isEmailExist"), emailValidateType: "register")
        && Validation::Validate($password, array("required", "minLength", "passwordConfirmation"), passwordConfirmation: $passwordConfirmation)
    ) {
        try {
            $newUser = new User($firstname, $lastname, $email, $password);
            $newUser->register();
            echo "<div class='alert alert-green center-block'> <h3>New user is registered</h3> </div>";
        } catch(Exception $e) {
            echo '<br>'. $e;
        }
    }
}
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
    <div class="center-block">
        <form method="POST">
            <label for="firstname">Firstname</label><br>
            <input class="input" type="text" id="firstname" name="firstname" placeholder="First name"><br>
            <label for="lastname">Lastname</label><br>
            <input class="input" type="text" id="lastname" name="lastname" placeholder="Last name"><br>
            <label for="email">Email</label><br>
            <input class="input" type="email" id="email" name="email" placeholder="Email"><br>
            <label for="password">Password</label><br>
            <input class="input" type="password" id="password" name="password" placeholder="Password"><br>
            <label for="password_confirmation">Repeat password</label><br>
            <input class="input" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password"><br>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>