<?php

namespace app\config;

class View {
    public static function render(string $view, array $data) {
        extract($data);
        require_once __DIR__ . '/../view/' . $view .'.php';
    }
}