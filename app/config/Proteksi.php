<?php
namespace app\config;
class Proteksi
{

    public static function proteksilogin()

    {

        if (!isset($_SESSION['user_id'])) {

            $_SESSION['flash_error'] = "Kamu harus login terlebih dahulu!";

            header("Location: /login");

            exit();
        }
    }
}
