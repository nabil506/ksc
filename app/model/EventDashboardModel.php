<?php

namespace app\model;

use app\config\Database;

class EventDashboardModel
{
    public static function getAllEvents()
    {
        $db = Database::getConnection();
        $query = "SELECT * FROM events ORDER BY tanggal_event ASC";
        return $db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Fungsi Admin: Tambah event (Sekarang pakai deskripsi)
    public static function tambahEvent($nama_event, $tanggal, $lokasi, $deskripsi)
    {
        $db = Database::getConnection();
        $query = "INSERT INTO events (nama_event, tanggal_event, lokasi, deskripsi, status) VALUES (?, ?, ?, ?, 'Upcoming')";
        $stmt = $db->prepare($query);
        return $stmt->execute([$nama_event, $tanggal, $lokasi, $deskripsi]);
    }

    // Fungsi Atlet: Mendaftar ke event tertentu (Kategori dihapus)
    public static function daftarEvent($user_id, $event_id)
    {
        $db = Database::getConnection();
        // Kolom kategori kita abaikan atau biarkan kosong (tergantung setting DB Anda, aman diabaikan jika bisa NULL)
        $query = "INSERT INTO pendaftaran (user_id, event_id) VALUES (?, ?)";
        $stmt = $db->prepare($query);
        return $stmt->execute([$user_id, $event_id]);
    }

    // Fungsi Baru: Mengambil ID event yang sudah didaftar oleh user ini
    public static function getRegisteredEventIds($user_id)
    {
        $db = Database::getConnection();
        $query = "SELECT event_id FROM pendaftaran WHERE user_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN); // Akan mengembalikan array ID, misal: [1, 4, 5]
    }
    // Fungsi Admin: Edit/Update Data Event
    public static function editEvent($id, $nama, $tanggal, $lokasi, $deskripsi)
    {
        $db = Database::getConnection();
        $query = "UPDATE events SET nama_event = ?, tanggal_event = ?, lokasi = ?, deskripsi = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        return $stmt->execute([$nama, $tanggal, $lokasi, $deskripsi, $id]);
    }

    // Fungsi Admin: Hapus Event
    public static function hapusEvent($id)
    {
        $db = Database::getConnection();
        $query = "DELETE FROM events WHERE id = ?";
        $stmt = $db->prepare($query);
        return $stmt->execute([$id]);
    }
}
