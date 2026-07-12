<?php

namespace app\controller;
use app\model\EventDashboardModel;
use app\model\HomeModel;
use app\config\View;

class AboutController
{

    public function about()
    {
        $events = EventDashboardModel::getAllEvents();
        $atlitAktif = HomeModel::getAtlitAktif();
        $pelatihAktif = HomeModel::getPelatihAktif();
        $pelatihList = HomeModel::getDaftarPelatih();
        // 2. Render tampilan home (Sesuaikan dengan fungsi load view-mu, ini contoh umumnya)
        View::render(
            'homepage/about',
            [
                'events' => $events,
                'atlitAktif' => $atlitAktif,
                'pelatihAktif' => $pelatihAktif,
                'pelatihList' => $pelatihList,
            ]
        );
    }
}
