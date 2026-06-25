<?php

namespace app\model;

use app\config\Database;

class BiodataModel
{
    public static function editprofil(array $data, $id)
    {
        $db = Database::getConnection();
        
        $fields = [];
        $params = [];

        // Membentuk bagian "SET column1 = ?, column2 = ?"
        foreach ($data as $column => $value) {
            $fields[] = "$column = ?";
            $params[] = $value;
        }

        // Jika tidak ada data yang diupdate, hentikan
        if (empty($fields)) return false;

        $params[] = $id; // Tambahkan ID untuk WHERE
        $query = "UPDATE atlit SET " . implode(", ", $fields) . " WHERE user_id = ?";
        
        $stmt = $db->prepare($query);
        return $stmt->execute($params);
    }
}