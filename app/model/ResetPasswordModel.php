<?php

namespace app\model;

use app\config\Database;
use PDOException;

class ResetPasswordModel
{
    /**
     * 1. Cek apakah email terdaftar di tabel users
     */
    public static function checkEmailExists($email)
    {
        try {
            $db = Database::getConnection();
            $query = "SELECT email, nama_lengkap FROM users WHERE email = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$email]);
            
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * 2. Simpan kode OTP ke tabel password_resets
     */
    public static function saveOtp($email, $otp, $expired_at)
    {
        try {
            $db = Database::getConnection();
            
            // Hapus OTP lama terlebih dahulu (berjaga-jaga jika user request OTP 2x berturut-turut)
            $queryDelete = "DELETE FROM password_resets WHERE email = ?";
            $stmtDelete = $db->prepare($queryDelete);
            $stmtDelete->execute([$email]);

            // Masukkan OTP yang baru
            $queryInsert = "INSERT INTO password_resets (email, otp, expired_at) VALUES (?, ?, ?)";
            $stmtInsert = $db->prepare($queryInsert);
            
            return $stmtInsert->execute([$email, $otp, $expired_at]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * 3. Verifikasi apakah kode OTP ada di tabel password_resets dan belum hangus
     */
    public static function verifyOtp($email, $otp)
    {
        try {
            $db = Database::getConnection();
            
            // Ambil data OTP yang email dan kodenya cocok, serta waktunya masih berlaku
            $query = "SELECT id FROM password_resets WHERE email = ? AND otp = ? AND expired_at > NOW()";
            $stmt = $db->prepare($query);
            $stmt->execute([$email, $otp]);
            
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * 4. Ganti password di tabel users, lalu musnahkan OTP dari tabel password_resets
     */
    public static function updatePassword($email, $new_password)
    {
        try {
            $db = Database::getConnection();
            
            // Update password di tabel utama (users)
            $queryUpdate = "UPDATE users SET password = ? WHERE email = ?";
            $stmtUpdate = $db->prepare($queryUpdate);
            $updateSuccess = $stmtUpdate->execute([$new_password, $email]);

            // Jika berhasil ubah password, hapus sisa data OTP agar tidak bisa dipakai ulang
            if ($updateSuccess) {
                $queryDelete = "DELETE FROM password_resets WHERE email = ?";
                $stmtDelete = $db->prepare($queryDelete);
                $stmtDelete->execute([$email]);
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
}