<?php

namespace app\controller;
use app\config\View;
use app\model\HomeModel;
use app\model\JadwalModel;

class PelatihController
{
    public function pelatih()
    {
        $pelatihAktif = HomeModel::getDaftarPelatih();
        $jadwalPelatih = JadwalModel::getAllJadwal();
        View::render(
            'homepage/pelatih',
            [
                'jadwalPelatih' => $jadwalPelatih,
                'pelatihAktif' => $pelatihAktif,
            ]
        );
    }
}
