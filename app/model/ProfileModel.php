<?php

namespace app\model;

use app\config\Database;
use PDOException;

class ProfileModel
{
    public static function editprofil(array $data, $id)
    {
        try {
            $db = Database::getConnection();

            $fields = [];
            $params = [];

            foreach ($data as $column => $value) {
                $fields[] = "$column = ?";
                $params[] = $value;
            }

            if (empty($fields)) return false;

            $params[] = $id;
            $query = "UPDATE users SET " . implode(", ", $fields) . " WHERE id = ?";

            $stmt = $db->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
