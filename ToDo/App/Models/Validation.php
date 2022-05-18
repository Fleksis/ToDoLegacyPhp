<?php

class Validation {
    public static function Validate($parameter, array $criteria, string $emailValidateType = null, string $passwordConfirmation = null, string $email = null): bool {
        for ($i = 0; $i < count($criteria); $i++) {
            switch ($criteria[$i]) {
                case "required":
                    if (self::Required($parameter)) {break;} else {return false;}
                case "minLength":
                    if (self::MinLength($parameter)) {break;} else {return false;}
                case "isEmail":
                    if (self::IsEmail($parameter)) {break;} else {return false;}
                case "passwordConfirmation":
                    if (self::PasswordConfirmation($parameter, $passwordConfirmation)) {break;} else {return false;}
                case "isEmailExist":
                    if (self::IsEmailExist($parameter, $emailValidateType)) {break;} else {return false;}
                case "isPasswordCorrect":
                    if (self::IsPasswordCorrect($parameter, $email)) {break;} else {return false;}
            }
        }
        return true;
    }

    private static function Required($parameter): bool {
        if (empty($parameter)) {
            echo "<div class='alert alert-red center-block'> <h3>Input is empty</h3> </div>";
            return false;
        } else {
            return true;
        }
    }

    private static function MinLength($parameter): bool {
        if (strlen($parameter) <= 6) {
            echo "<div class='alert alert-red center-block'> <h3>Password is too short</h3> </div>";
            return false;
        } else {
            return true;
        }
    }

    private static function IsEmail($parameter): bool {
        if (!filter_var($parameter, FILTER_VALIDATE_EMAIL)) {
            echo "<div class='alert alert-red center-block'> <h3>Email is not valid</h3> </div>";
            return false;
        } else {
            return true;
        }
    }

    private static function IsEmailExist($parameter, $emailValidateType): bool {
        try {
            $stmt = (new Database)->get()->prepare("SELECT * FROM users WHERE email='$parameter'");
            $stmt->execute();
            $count = $stmt->rowCount();

            if ($count >= 1 && $emailValidateType == "register") {
                echo "<div class='alert alert-red center-block'> <h3>Email alredy exist</h3> </div>";
                return false;
            } else if($count <= 0 && $emailValidateType == "login"){
                echo "<div class='alert alert-red center-block'> <h3>Email does not exist</h3> </div>";
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            echo '<br>'. $e;
            return false;
        }
    }

    private static function PasswordConfirmation($parameter, $passwordConfirmation): bool {
        if ($parameter != $passwordConfirmation) {
            echo "<div class='alert alert-red center-block'> <h3>Repeated password is incorrect</h3> </div>";
            return false;
        } else {
            return true;
        }
    }

    private static function IsPasswordCorrect($parameter, $email) {
        $stmt = (new Database)->get()->query("SELECT * FROM users WHERE email='$email'");
        $user = $stmt->fetchAll();

        $userPassword = $user[0]['password'];
        if ($userPassword == $parameter) {
            return true;
        } else {
            return false;
        }
    }
}