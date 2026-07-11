<?php

namespace app\model;

use app\config\Database;

class AdminModel
{
    // Mengambil semua user beserta nama, role, dan statusnya
    public static function getAllUsers()
    {
        $db = Database::getConnection();
        $query = "
        SELECT users.*, roles.role_name 
        FROM users 
        INNER JOIN roles ON users.id_role = roles.id        ";

        return $db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function updatestatus($status_anggota, $id)
    {
        $db = Database::getConnection();
        $query = "UPDATE users SET status_anggota = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        return $stmt->execute([$status_anggota, $id]);
    }
}
