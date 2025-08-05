<?php
class validate
{
    //check for empty fields
    public function checkEmpty($data, $fields){
        $msg = null;
        foreach ($fields as $value) {
            if(empty($data[$value])){
                $msg []= $value . " field cannot be empty";
            }
        }
        return $msg;
    }
    //check our email format
    public function validEmail($email){
        return preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|org|edu)$/", $email);
    }

    //check our user name
    public function validUsername($username){
        if (strlen($username) < 4) {
            return "Username must be at least 4 characters long";
        }
        if (!preg_match("/^[a-zA-Z0-9- ]+$/", $username)) {
            return "Username must only contain letters, space, numbers, and hyphens.";
        }
        return preg_match("/^[a-zA-Z0-9 -]+$/", $username);
    }

    //check our user name password
    public function validPassword($password) {
        $errors = [];

        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        }

        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "Password must contain at least one uppercase letter.";
        }

        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = "Password must contain at least one lowercase letter.";
        }

        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = "Password must contain at least one number.";
        }

        if (!preg_match('/[\W_]/', $password)) {
            $errors[] = "Password must contain at least one special character.";
        }

        return $errors;
    }
}
?>