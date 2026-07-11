<?php

namespace app\controller;


use app\config\Proteksi;
use app\config\View;
class ProfilController
{

    public function profil()
    {
        Proteksi::proteksilogin();
        $user = $_SESSION['user'];
        View::render('dashboard/profil', $user);
    }
}
