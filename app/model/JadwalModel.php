<?php

namespace app\model;

use app\config\Database;
use PDOException;

class JadwalModel
{
    // 1. Mengambil semua jadwal dan digabung (JOIN) dengan tabel users untuk dapat nama pelatih
    public static function getAllJadwal()
    {
        try {
            $db = Database::getConnection();
            $query = "
                SELECT j.*, u.nama_lengkap as nama_pelatih 
                FROM jadwal j
                JOIN users u ON j.id_pelatih = u.id
                ORDER BY FIELD(j.hari,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu', 'Minggu'), j.waktu ASC
            ";
            return $db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // 2. Mengambil daftar pelatih yang aktif untuk pilihan di Form Tambah Jadwal
    public static function getDaftarPelatih()
    {
        try {
            $db = Database::getConnection();
            $query = "
                SELECT u.id, u.nama_lengkap 
                FROM users u
                JOIN roles r ON u.id_role = r.id
                WHERE r.role_name = 'pelatih' AND u.status_anggota = 'Aktif'
            ";
            return $db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // 3. Menyimpan jadwal baru ke database
    public static function tambahJadwal($hari, $waktu, $id_pelatih, $kolam, $keterangan)
    {
        try {
            $db = Database::getConnection();
            $query = "INSERT INTO jadwal (hari, waktu, id_pelatih, kolam, keterangan) VALUES (?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            return $stmt->execute([$hari, $waktu, $id_pelatih, $kolam, $keterangan]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // 4. Menghapus jadwal dari database berdasarkan ID
    public static function hapusJadwal($id)
    {
        try{

            $db = Database::getConnection();
            $query = "DELETE FROM jadwal WHERE id = ?";
            $stmt = $db->prepare($query);
            return $stmt->execute([$id]);
            }catch(PDOException $e){
                return $e->getMessage();
            }
    }
}
