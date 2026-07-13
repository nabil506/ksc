<?php

namespace app\controller;

use app\model\EventDashboardModel;
use app\config\Proteksi;
use app\config\View;

class EventDashboardController
{
    public function eventdashboard()
    {
        Proteksi::proteksilogin();
        $events = EventDashboardModel::getAllEvents();
        $registeredEvents = [];

        // Status atlit
        $isAktif = (isset($_SESSION['user']['status_anggota']) && strtolower($_SESSION['user']['status_anggota']) === 'aktif');
        if (isset($_SESSION['user']['user_id']) && $_SESSION['user']['role_name'] === 'atlit') {
            $registeredEvents = EventDashboardModel::getRegisteredEventIds($_SESSION['user']['user_id']);
        }

        $user = $_SESSION['user'];


        View::render(
            'dashboard/eventdashboard',
            [
                'events'           => $events,
                'registeredEvents' => $registeredEvents,
                'isAktif'          => $isAktif,
                'today'            => strtotime(date('Y-m-d')),
                'user' => $user,
            ]
        );
    }
    public function prosesTambah()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['role_name'] === 'admin') {
            $nama = $_POST['nama'] ?? '';
            $tanggal = $_POST['tanggal'] ?? '';
            $lokasi = $_POST['lokasi'] ?? '';
            $deskripsi = $_POST['deskripsi'] ?? '';

            EventDashboardModel::tambahEvent($nama, $tanggal, $lokasi, $deskripsi);

            header("Location: /dashboardevent");
            exit();
        }
    }

    public function prosesDaftar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user']) && $_SESSION['user']['role_name'] === 'atlit') {

            $userId = $_SESSION['user']['id'] ?? $_SESSION['user']['user_id'] ?? null;
            $eventId = $_POST['event_id'] ?? '';

            if (!$userId) {
                $_SESSION['flash_error'] = "Sesi login tidak valid atau kadaluarsa. Silakan login ulang.";
                header("Location: /login");
                exit();
            }

            $sudahDaftar = in_array($eventId, EventDashboardModel::getRegisteredEventIds($userId));

            if (!$sudahDaftar) {
                EventDashboardModel::daftarEvent($userId, $eventId);
                // UBAH NAMA SESSION MENJADI KHUSUS EVENT
                $_SESSION['flash_event_sukses'] = "Berhasil mendaftar event!";
            } else {
                // UBAH NAMA SESSION MENJADI KHUSUS EVENT
                $_SESSION['flash_event_error'] = "Anda sudah terdaftar di event ini.";
            }

            // UBAH ARAH REDIRECT KEMBALI KE HALAMAN EVENT
            header("Location: /dashboardevent");
            exit();
        } else {
            header("Location: /dashboardevent");
            exit();
        }
    }
    public function editEvent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['event_id'];
            $nama = $_POST['nama'];
            $tanggal = $_POST['tanggal'];
            $lokasi = $_POST['lokasi'];
            $deskripsi = $_POST['deskripsi'];

            EventDashboardModel::editEvent($id, $nama, $tanggal, $lokasi, $deskripsi);

            // Arahkan kembali ke halaman dashboard event
            header("Location: /dashboardevent");
            exit;
        }
    }

    // Proses Hapus Event
    public function hapusEvent()
    {
        $event_id = $_POST['event_id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
            EventDashboardModel::hapusEvent($event_id);

            // Arahkan kembali ke halaman dashboard event
            header("Location: /dashboardevent");
            exit;
        }
    }
}
