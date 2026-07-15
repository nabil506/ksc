<?php
session_start();
require_once 'vendor/autoload.php';

use app\controller\AboutController;
use app\controller\AdminController;
use app\controller\BiodataController;
use app\controller\DashboardController;
use app\controller\EventController;
use app\core\Route;
use app\controller\HomeController;
use app\controller\LoginController;
use app\controller\RegisterController;
use app\controller\EventDashboardController;
use app\controller\ProfilController;
use app\controller\RiwayatController;
use app\controller\JadwalController;
use app\controller\PelatihController;
use app\controller\ProfileController;

// --- RUTE WEB PUBLIK ---
Route::get('/', HomeController::class, 'index');
Route::get('/about', AboutController::class, 'about');
Route::get('/pelatih', PelatihController::class, 'pelatih');
Route::get('/event', EventController::class, 'event');
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
Route::get('/dashboard', DashboardController::class, 'dashboard');
Route::get('/profil', ProfileController::class, 'profil');
Route::post('/update-profile', ProfileController::class, 'prosesedit');
Route::get('/jadwal', JadwalController::class, 'jadwal');
Route::post('/tambah-jadwal', JadwalController::class, 'tambah');
Route::post('/hapus-jadwal', JadwalController::class, 'hapus');
Route::get('/riwayat', RiwayatController::class, 'riwayat');

// --- RUTE KHUSUS ADMIN ---
Route::get('/manage-users', AdminController::class, 'manageUsers');
Route::post('/update-status', AdminController::class, 'updateStatus');
Route::get('/tambah-pelatih', AdminController::class, 'tambahPelatih');
Route::post('/proses-tambah-pelatih', AdminController::class, 'prosesTambahPelatih');

//rute event
Route::get('/dashboardevent', EventDashboardController::class, 'eventdashboard');
Route::post('/proses-tambah-event', EventDashboardController::class, 'prosesTambah');
Route::post('/proses-daftar-event', EventDashboardController::class, 'prosesDaftar');
Route::post('/proses-edit-event', EventDashboardController::class, 'editEvent');
Route::post('/proses-hapus-event', EventDashboardController::class, 'hapusEvent');

Route::run();
