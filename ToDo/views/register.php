<?php
use App\Models\Validation;
use App\Models\User;

require '../database/db.php';

spl_autoload_register(function($class){
    $path = str_replace('\\', '/',"..\\".$class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

if(!empty($_POST)) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirmation = $_POST['password_confirmation'];

    if (Validation::Validate($firstname, array("required")) && Validation::Validate($lastname, array("require")) && Validation::Validate($email, array("required", "isEmail, isEmailExist")) && Validation::Validate($password, array("required", "minLength", "passwordConfirmation"), $passwordConfirmation)) {
        try {
            $newUser = new User($firstname, $lastname, $email, $password);
            $conn = ConnectDatabase();
            $newUser->newUser($conn);
        } catch(Exception $e) {
            echo '<br>'.$e;
        }

    } else {
        echo '<div class="center-block" role="alert">Nederīgs epasts</div>';
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
            <label class="input-padding" for="firstname">Firstname</label><br>
            <input type="text" id="firstname" name="firstname" placeholder="First name">
            <label class="input-padding" for="lastname">Lastname</label><br>
            <input type="text" id="lastname" name="lastname" placeholder="Last name">
            <label class="input-padding" for="email">Email</label><br>
            <input type="email" id="email" name="email" placeholder="Email">
            <label class="input-padding" for="password">Password</label><br>
            <input type="password" id="password" name="password" placeholder="Password">
            <label class="input-padding" for="password_confirmation">Repeat password</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password"><br>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>