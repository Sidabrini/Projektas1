<?php

class User
{
    private $email;
    private $password_hash;

    /**
     * User constructor.
     * @param $newEmail
     * @param $pass
     */
    function __construct($newEmail, $pass)
    {
        $this->email = $newEmail;
        $this->password_hash = password_hash($pass,1);
    }

    /**
     * @param $pass
     * @param $email
     * @return bool
     */
    public function login_verify($pass, $email){
        if(password_verify($pass,$this->password_hash) && $email === $this->email){
            return true;
        }

        return false;
    }

}