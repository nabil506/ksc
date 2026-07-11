<?php
namespace app\config;

class HashPassword{

    public static function passwordhash($password){
        password_hash($password, PASSWORD_BCRYPT);
    }
}