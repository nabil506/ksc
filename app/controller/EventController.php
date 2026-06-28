<?php

namespace app\controller;

use app\model\EventModel;

class EventController
{
    public function eventdashboard()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $events = EventModel::getAllEvents();
        $registeredEvents = []; // Default kosong

        // Jika yang login atlit, ambil daftar ID event yang sudah dia ikuti
        if (isset($_SESSION['user_id']) && $_SESSION['role_aktif'] === 'atlit') {
            $registeredEvents = EventModel::getRegisteredEventIds($_SESSION['user_id']);
        }

        require_once __DIR__ . '/../view/eventdashboard.php';
    }
    public function prosesTambah()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['role_aktif'] === 'admin') {
            $nama = $_POST['nama'];
            $tanggal = $_POST['tanggal'];
            $lokasi = $_POST['lokasi'];
            $deskripsi = $_POST['deskripsi'] ?? ''; // Menangkap deskripsi

            EventModel::tambahEvent($nama, $tanggal, $lokasi, $deskripsi);

            header("Location: /dashboardevent");
            exit();
        }
    }

    public function prosesDaftar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['role_aktif'] === 'atlit') {
            $userId = $_SESSION['user_id'];
            $eventId = $_POST['event_id'];

            // Pengecekan Keamanan Ganda: Cek apakah user sudah daftar di database
            $sudahDaftar = in_array($eventId, EventModel::getRegisteredEventIds($userId));

            if (!$sudahDaftar) {
                // Jika belum, baru masukkan ke database (tanpa kategori)
                EventModel::daftarEvent($userId, $eventId);
                $_SESSION['flash_sukses'] = "Berhasil mendaftar event!";
            } else {
                $_SESSION['flash_error'] = "Anda sudah terdaftar di event ini.";
            }

            header("Location: /riwayat");
            exit();
        }
    }
}
