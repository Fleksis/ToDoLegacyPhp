<?php

namespace App\Models;
require_once '../database/db.php';
class Validation {
    public static function Validate($parameter, array $criteria, string $passwordConfirmation = null, $conn = null): bool
    {
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
                    if (self::IsEmailExist($parameter)) {break;} else {return false;}
            }

        }
        return true;
    }

    private static function Required($parameter): bool
    {
        if (empty($parameter)) {
            return false;
        } else {
            return true;
        }
    }

    private static function MinLength($parameter): bool
    {
        if (strlen($parameter) <= 6) {
            echo "Password is too short";
            return false;
        } else {
            return true;
        }
    }

    private static function IsEmail($parameter): bool
    {
        if (!filter_var($parameter, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }
    }

    private static function IsEmailExist($parameter): bool
    {
        $sql = "SELECT * FROM users WHERE email=$parameter";
        $result = $conn->query($sql);
        $count = $conn->rowCount();
        echo $count
        return true;
    }

    private static function PasswordConfirmation($parameter, $passwordConfirmation): bool
    {
        if ($parameter != $passwordConfirmation) {
            return false;
        } else {
            return true;
        }
    }
}

// (required, isEmail, minLength, passwordConfirmation, , , , )

