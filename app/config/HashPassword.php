<?php
namespace app\config;

class HashPassword{
    public static function hashpassword($password){
       return  password_hash($password, PASSWORD_BCRYPT);
    }
}