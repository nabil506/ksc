<?php

namespace app\controller;

use app\config\Proteksi;

class HomeController
{

    public function index()
    {
        require_once __DIR__ . '/../view/home.php';
    }

    public function about()
    {
        require_once __DIR__ . '/../view/about.php';
    }
    public function pelatih()
    {
        require_once __DIR__ . '/../view/pelatih.php';
    }
    public function event()
    {
        require_once __DIR__ . '/../view/event.php';
    }
    public function galeri()
    {
        require_once __DIR__ . '/../view/galeri.php';
    }
    public function fasilitas()
    {
        require_once __DIR__ . '/../view/fasilitas.php';
    }
    public function kontak()
    {
        require_once __DIR__ . '/../view/kontak.php';
    }
    public function dashboard()
    {
        Proteksi::proteksilogin();
        require_once __DIR__ . '/../view/dashboard.php';
    }
    public function profil()
    {
        Proteksi::proteksilogin();
        require __DIR__ . '/../view/profil.php';
    }
    public function jadwal()
    {
        Proteksi::proteksilogin();
        require __DIR__ . '/../view/jadwal.php';
    }
}
