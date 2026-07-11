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
        $isAktif = (isset($_SESSION['user']['status_anggota']) && $_SESSION['user']['status_anggota'] === 'Aktif');

        if (isset($_SESSION['user']['user_id']) && $_SESSION['user']['role_name'] === 'atlit') {
            $registeredEvents = EventDashboardModel::getRegisteredEventIds($_SESSION['user']['user_id']);
        }

        // Gabungkan semua data ke dalam satu array
        $user = $_SESSION['user'];
        $data = [
            'events'           => $events,
            'registeredEvents' => $registeredEvents,
            'isAktif'          => $isAktif,
            'today'            => strtotime(date('Y-m-d')),
        ];

        View::render(
            'dashboard/eventdashboard',
            [
                'data' => $data,
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
            $deskripsi = $_POST['deskripsi'] ?? ''; // Menangkap deskripsi

            EventDashboardModel::tambahEvent($nama, $tanggal, $lokasi, $deskripsi);

            header("Location: /dashboardevent");
            exit();
        }
    }

    public function prosesDaftar()
    {
        // 1. Perbaiki pengecekan session menggunakan struktur $_SESSION['user']
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user']) && $_SESSION['user']['role_name'] === 'atlit') {

            // 2. Ambil ID User dari dalam array ['user']. 
            // Kita gunakan fallback ('id' atau 'user_id') untuk menyesuaikan dengan LoginController milikmu
            $userId = $_SESSION['user']['id'] ?? $_SESSION['user']['user_id'] ?? null;
            $eventId = $_POST['event_id'] ?? '';

            // 3. Validasi tambahan: Jika $userId tetap kosong, arahkan untuk login ulang
            if (!$userId) {
                $_SESSION['flash_error'] = "Sesi login tidak valid atau kadaluarsa. Silakan login ulang.";
                header("Location: /login");
                exit();
            }

            // Pengecekan Keamanan Ganda: Cek apakah user sudah daftar di database
            $sudahDaftar = in_array($eventId, EventDashboardModel::getRegisteredEventIds($userId));

            if (!$sudahDaftar) {
                // Jika belum, baru masukkan ke database
                EventDashboardModel::daftarEvent($userId, $eventId);
                $_SESSION['flash_sukses'] = "Berhasil mendaftar event!";
            } else {
                $_SESSION['flash_error'] = "Anda sudah terdaftar di event ini.";
            }

            header("Location: /riwayat");
            exit();
        } else {
            // Jika yang mengakses bukan atlit atau bukan POST
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
