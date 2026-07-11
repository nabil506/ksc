<?php

namespace app\model;

use app\config\Database;

class RiwayatModel
{
    // Fungsi untuk Atlit: Hanya mengambil riwayat miliknya sendiri
    public static function getRiwayatByUserId($user_id)
    {
        $db = Database::getConnection();

        $query = "
            SELECT 
                p.id,
                p.tanggal_daftar,
                e.nama_event,
                e.status as status_event,
                u.nama_lengkap as nama_atlet
            FROM pendaftaran p
            JOIN events e ON p.event_id = e.id
            JOIN users u ON p.user_id = u.id
            WHERE p.user_id = ?
            ORDER BY p.tanggal_daftar DESC
        ";

        $stmt = $db->prepare($query);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Fungsi untuk Admin: Mengambil SEMUA riwayat pendaftaran dari semua atlit
    public static function getAllRiwayat()
    {
        $db = Database::getConnection();
        
        // HAPUS JOIN KE TABEL ATLIT. Langsung ambil u.nama_lengkap dari tabel users.
        $query = "
            SELECT 
                p.id,
                p.tanggal_daftar,
                e.nama_event,
                e.status as status_event,
                u.nama_lengkap as nama_atlet
            FROM pendaftaran p
            JOIN events e ON p.event_id = e.id
            JOIN users u ON p.user_id = u.id
            ORDER BY p.tanggal_daftar DESC
        ";
        
        return $db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }
}