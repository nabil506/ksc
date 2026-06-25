<?php
require_once 'vendor/autoload.php';

use app\controller\AdminController;
use app\controller\BiodataController;
use app\core\Route;
use app\controller\HomeController;
use app\controller\LoginController;
use app\controller\RegisterController;

// --- RUTE WEB PUBLIK ---
Route::get('/', HomeController::class, 'index');
Route::get('/about', HomeController::class, 'about');
Route::get('/pelatih', HomeController::class, 'pelatih');
Route::get('/event', HomeController::class, 'event');
Route::get('/galeri', HomeController::class, 'galeri');
Route::get('/fasilitas', HomeController::class, 'fasilitas');
Route::get('/kontak', HomeController::class, 'kontak');

// --- RUTE AUTENTIKASI & REGISTRASI (PUBLIK/ATLIT) ---
Route::get('/register', RegisterController::class, 'register');
Route::post('/proses-register', RegisterController::class, 'prosesregister');
Route::get('/login', LoginController::class, 'login');
Route::post('/proses-login', LoginController::class, 'proseslogin');
Route::get('/logout', LoginController::class, 'logout');

// --- RUTE DASHBOARD UMUM (Atlit & Pelatih & Admin) ---
Route::get('/dashboard', HomeController::class, 'dashboard');
Route::get('/profil', HomeController::class, 'profil');
Route::post('/update-profile', BiodataController::class, 'prosesedit');
Route::get('/jadwal', HomeController::class, 'jadwal');
Route::get('/dashboardevent', HomeController::class, 'eventdashboard');
Route::get('/riwayat', HomeController::class, 'riwayat');

// --- RUTE KHUSUS ADMIN ---
Route::get('/manage-users', AdminController::class, 'manageUsers');
Route::post('/update-status', AdminController::class, 'updateStatus');
Route::get('/tambah-pelatih', AdminController::class, 'tambahPelatih');
Route::post('/proses-tambah-pelatih', AdminController::class, 'prosesTambahPelatih');

Route::run();