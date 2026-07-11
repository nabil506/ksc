<?php

namespace app\model;

use app\config\Database;
use PDOException;

class LoginModel
{

    public static function checkEmail($inputLogin)
    {
        try {
            $db = Database::getConnection();

            $query = "
                SELECT
                    users.*,
                    roles.role_name
                FROM users
                JOIN roles ON users.id_role = roles.id
                WHERE users.email = ? OR BINARY users.nama_lengkap = ?
            ";

            $stmt = $db->prepare($query);
            $stmt->execute([$inputLogin, $inputLogin]);
            $user = $stmt->fetch();

            if ($user) {
                return $user;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
