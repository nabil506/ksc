<?php

namespace app\controller;

use app\config\View;
use app\model\EventDashboardModel;
use app\model\HomeModel;

class HomeController
{

    public function index()
    {
        $events = EventDashboardModel::getAllEvents();
        $atlitAktif = HomeModel::getAtlitAktif();
        $pelatihAktif = HomeModel::getPelatihAktif();
        $pelatihList = HomeModel::getDaftarPelatih();
        View::render(
            'homepage/home',
            [
                'events' => $events,
                'atlitAktif' => $atlitAktif,
                'pelatihAktif' => $pelatihAktif,
                'pelatihList' => $pelatihList,
            ]
        );
    }
    public function galeri()
    {
        require_once __DIR__ . '/../view/homepage/galeri.php';
    }
    public function fasilitas()
    {
        require_once __DIR__ . '/../view/homepage/fasilitas.php';
    }
    public function kontak()
    {
        require_once __DIR__ . '/../view/homepage/kontak.php';
    }
}
