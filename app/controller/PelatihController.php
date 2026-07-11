<?php

namespace app\controller;
use app\config\View;
use app\model\HomeModel;
class PelatihController
{
    public function pelatih()
    {
        $pelatihAktif = HomeModel::getDaftarPelatih();
        View::render(
            'homepage/pelatih',
            [
                'pelatihAktif' => $pelatihAktif,
            ]
        );
    }
}
