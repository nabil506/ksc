<?php

namespace app\model;

use app\config\Database;

class AdminModel
{
    // Mengambil semua user beserta nama, role, dan statusnya
    public static function getAllUsers()
    {
        $db = Database::getConnection();

        // COALESCE akan memilih nilai pertama yang tidak NULL (Nama Atlit, atau Nama Pelatih, atau default 'Admin')
        $query = "
            SELECT 
                users.id, 
                users.email, 
                users.role, 
                users.status_anggota,
                COALESCE(atlit.nama_lengkap, pelatih.nama_pelatih, 'Admin KSC') AS nama_lengkap
            FROM users
            LEFT JOIN atlit  ON users.id = atlit.user_id
            LEFT JOIN pelatih  ON users.id = pelatih.user_id
            ORDER BY users.role ASC, users.id DESC
        ";

        return $db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function updatestatus($status_anggota , $id)
    {
        $db =Database::getConnection();
        $query = "UPDATE users SET status_anggota = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        return $stmt -> execute([$status_anggota, $id]);
    }
}
