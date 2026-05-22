<?php

use App\Http\Controllers\AksesPengguna;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesaKelompok;
use App\Http\Controllers\GenerasiPenerus;
use App\Http\Controllers\KegiatanGenerus;
use App\Http\Controllers\Laporan\LaporanKegiatanGenerus;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PresensiKegiatan;
use App\Http\Controllers\PresensiKegiatanKartu;

// TEMANPENGURUS
use App\Http\Controllers\TemanPengurus\Dashboard;
use App\Http\Controllers\TemanPengurus\DesaKelompok as TemanPengurusDesaKelompok;
use App\Http\Controllers\TemanPengurus\KegiatanPengurus;
use App\Http\Controllers\TemanPengurus\Pengurus;
use App\Http\Controllers\TemanPengurus\PresensiKegiatan as TemanPengurusPresensiKegiatan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // Jika belum login → tampilkan halaman login
    if (!auth()->check()) {
        return redirect()->route('login.index');
    }

    // Jika sudah login → arahkan sesuai role
    $user = auth()->user();

    // if ($user->peran === 'kantin') {
    //     return redirect()->route('smartCanteen.dashboard');
    // }

    return redirect()->route('dashboard.index');
})->name('home');

// login
Route::get('/login', [LoginController::class, 'index'])
    ->name('login.index')
    ->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate'])
    ->name('login.authenticate');

Route::post('/logout', [LoginController::class, 'logOut'])
    ->name('logout');

Route::get('/operasional/presensi-kegiatan-kartu/{token}',  [PresensiKegiatanKartu::class, 'index'])->name('operasional.presensi-kegiatan-kartu');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/operasional/presensi-kegiatan/{token}',  [PresensiKegiatan::class, 'index'])->name('operasional.presensi-kegiatan');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


    /*
    |--------------------------------------------------------------------------
    | TEMAN PENGURUS
    |--------------------------------------------------------------------------
    */
    Route::get('/temanpengurus/dashboard', [Dashboard::class, 'index'])->name('temanpengurus.dashboard.index');
    Route::get('/temanpengurus/administrasi/desa-kelompok', [TemanPengurusDesaKelompok::class, 'index'])->name('temanpengurus.administrasi.desa-kelompok');
    Route::get('/temanpengurus/administrasi/pengurus', [Pengurus::class, 'index'])->name('temanpengurus.administrasi.pengurus');
    Route::get('/temanpengurus/administrasi/kegiatan', [KegiatanPengurus::class, 'index'])->name('temanpengurus.administrasi.kegiatan-pengurus');

    Route::get('/temanpengurus/presensi-kegiatan/{token}',  [TemanPengurusPresensiKegiatan::class, 'index'])->name('temanpengurus.presensi-kegiatan');

    // =========================
    // ADMINISTRASI (SUPERADMIN, DAERAH, DESA, KELOMPOK)
    // =========================
    Route::middleware(['peran:SUPERADMIN,DAERAH,DESA,KELOMPOK'])->group(function () {
        Route::get('/administrasi/desa-kelompok', [DesaKelompok::class, 'index'])
            ->name('administrasi.desa-kelompok');

        Route::get('/administrasi/generasi-penerus', [GenerasiPenerus::class, 'index'])
            ->name('administrasi.generasi-penerus');

        Route::get('/administrasi/kegiatan-generus', [KegiatanGenerus::class, 'index'])
            ->name('administrasi.kegiatan-generus');
    });


    // =========================
    // LAPORAN DAERAH
    // =========================
    Route::middleware(['peran:SUPERADMIN,DAERAH'])->prefix('laporan/daerah')->name('laporan.daerah.')->group(function () {
        Route::get('/kegiatan-rutin', [LaporanKegiatanGenerus::class, 'rutinDaerah'])
            ->name('rutin');

        Route::get('/kegiatan-event', [LaporanKegiatanGenerus::class, 'eventDaerah'])
            ->name('event');
    });


    // =========================
    // LAPORAN DESA
    // =========================
    Route::middleware(['peran:SUPERADMIN,DESA'])->prefix('laporan/desa')->name('laporan.desa.')->group(function () {
        Route::get('/kegiatan-rutin', [LaporanKegiatanGenerus::class, 'rutinDesa'])
            ->name('rutin');

        Route::get('/kegiatan-event', [LaporanKegiatanGenerus::class, 'eventDesa'])
            ->name('event');
    });


    // =========================
    // LAPORAN KELOMPOK
    // =========================
    Route::middleware(['peran:SUPERADMIN,KELOMPOK'])->prefix('laporan/kelompok')->name('laporan.kelompok.')->group(function () {
        Route::get('/kegiatan-rutin', [LaporanKegiatanGenerus::class, 'rutinKelompok'])
            ->name('rutin');

        Route::get('/kegiatan-event', [LaporanKegiatanGenerus::class, 'eventKelompok'])
            ->name('event');
    });

    // sistem
    Route::get('/sistem/akses-pengguna',  [AksesPengguna::class, 'index'])->name('sistem.akses-pengguna');
});