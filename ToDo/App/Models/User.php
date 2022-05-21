<?php

class User {
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;
    private string $passwordConfirmation;

    public function __construct(string $firstName, string $lastName, string $email, string $password, string $passwordConfirmation = '') {
        $this->firstname = $firstName;
        $this->lastname = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->passwordConfirmation = $passwordConfirmation;

    }

    public function FirstName():string {
        return $this->firstname;
    }

    public function LastName():string {
        return $this->lastname;
    }

    public function Email():string {
        return $this->email;
    }

    public function Password():string {
        return $this->password;
    }

    public function register():bool {
        if (   Validation::Validate($this->firstname, array("required"))
            && Validation::Validate($this->lastname, array("required"))
            && Validation::Validate($this->email, array("required", "isEmail", "isEmailExist"), emailValidateType: "register")
            && Validation::Validate($this->password, array("required", "minLength", "passwordConfirmation"), passwordConfirmation: $this->passwordConfirmation)
        ) {
            try {
                $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$this->firstname', '$this->lastname', '$this->email', '$this->password')";
                (new Database)->get()->exec($sql);
                return true;
            } catch (Exception $e) {
                echo "<div class='alert alert-red center-block'> <h3>An error occurred</h3> </div>";
                return false;
            }
        } else {
            return false;
        }
    }

    public static function login(string $email, string $password):bool {
        $stmt = (new Database)->get()->query("SELECT * FROM users WHERE email='$email'");
        $user = $stmt->fetchAll();
        if($user[0]['password'] == $password) {
            echo "<div class='alert alert-green center-block'> <h3>You successfully logged in</h3> </div>";
            return true;
        } else {
            echo "<div class='alert alert-red center-block'> <h3>Password is incorrect</h3> </div>";
            return false;
        }
    }

    public static function navigationBar():void {
        if(empty($_SESSION['email'])) {
            echo '<a href="login.php">Login</a>';
            echo '<a href="register.php">Register</a>';
        } else {
            echo '<a href="logout.php">Logout</a>';
        }
    }
}

