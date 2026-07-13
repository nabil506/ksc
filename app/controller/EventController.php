<?php

namespace app\controller;

use app\config\View;
use app\model\EventDashboardModel;

class EventController
{
    public function event()
    {
        $allevent = EventDashboardModel::getAllEvents();
        View::render(
            'homepage/event',
            [
                'allevent' => $allevent,
                'today'    => strtotime(date('Y-m-d')),
            ]
        );
    }
}
