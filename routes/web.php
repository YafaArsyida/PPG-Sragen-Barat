<?php

use App\Http\Controllers\AksesPengguna;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesaKelompok;
use App\Http\Controllers\GenerasiPenerus;
use App\Http\Controllers\KBMdanKurikulum;
use App\Http\Controllers\KegiatanGenerus;
use App\Http\Controllers\KurikulumKBM;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OperasionalKegiatanGenerus;
use App\Http\Controllers\SistemController;
// TEMANPENGURUS
use App\Http\Controllers\TemanPengurus\Dashboard;
use App\Http\Controllers\TemanPengurus\DesaKelompok as TemanPengurusDesaKelompok;
use App\Http\Controllers\TemanPengurus\KegiatanPengurus;
use App\Http\Controllers\TemanPengurus\OperasionalKegiatanPengurus;
use App\Http\Controllers\TemanPengurus\Pengurus;
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

Route::get('/operasional/presensi-kegiatan-kartu/{token}',  [OperasionalKegiatanGenerus::class, 'kartu'])->name('operasional.presensi-kegiatan-kartu');

Route::get('/operasional/presensi-kegiatan/{token}',  [OperasionalKegiatanGenerus::class, 'manual'])->name('operasional.presensi-kegiatan');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // NOTULA
    Route::get('/notula', [DashboardController::class, 'notula'])->name('notula');


    /*
    |--------------------------------------------------------------------------
    | TEMAN PENGURUS
    |--------------------------------------------------------------------------
    */
    Route::get('/temanpengurus/dashboard', [Dashboard::class, 'index'])->name('temanpengurus.dashboard.index');
    Route::get('/temanpengurus/administrasi/desa-kelompok', [TemanPengurusDesaKelompok::class, 'index'])->name('temanpengurus.administrasi.desa-kelompok');
    Route::get('/temanpengurus/administrasi/pengurus', [Pengurus::class, 'index'])->name('temanpengurus.administrasi.pengurus');
    Route::get('/temanpengurus/administrasi/kegiatan', [KegiatanPengurus::class, 'index'])->name('temanpengurus.administrasi.kegiatan-pengurus');

    Route::get('/temanpengurus/operasional/kegiatan', [OperasionalKegiatanPengurus::class, 'index'])->name('temanpengurus.operasional.kegiatan-pengurus');

    Route::get('/temanpengurus/operasional/presensi-kegiatan/{token}',  [OperasionalKegiatanPengurus::class, 'manual'])->name('temanpengurus.operasional.presensi-kegiatan');


    // =========================
    // ADMINISTRASI
    // =========================
    Route::middleware(['peran:SUPERADMIN,ADMIN'])->group(function () {
        Route::get('/administrasi/desa-kelompok', [DesaKelompok::class, 'index'])
            ->name('administrasi.desa-kelompok');

        Route::get('/administrasi/generasi-penerus', [GenerasiPenerus::class, 'index'])
            ->name('administrasi.generasi-penerus');

        Route::get('/administrasi/kegiatan-generus', [KegiatanGenerus::class, 'index'])
            ->name('administrasi.kegiatan-generus');

        Route::get('/operasional/kegiatan-generus', [OperasionalKegiatanGenerus::class, 'index'])
            ->name('operasional.kegiatan-generus');

        //Kurikulum KBM
        Route::get('/kurikulum-kbm/periode-jenjang', [KurikulumKBM::class, 'periodeDanJenjang'])
            ->name('kurikulum-kbm.periode-jenjang');

        Route::get('/kurikulum-kbm/aspek-materi', [KurikulumKBM::class, 'aspekDanMateri'])
            ->name('kurikulum-kbm.aspek-materi');

        Route::get('/kurikulum-kbm/laporan-kbm', [KurikulumKBM::class, 'laporanKBM'])
            ->name('kurikulum-kbm.laporan-kbm');

        Route::get('/kurikulum-kbm/monitoring-kbm', [KurikulumKBM::class, 'monitoringKBM'])
            ->name('kurikulum-kbm.monitoring-kbm');
    });


    // =========================
    // LAPORAN DAERAH
    // =========================
    // Route::middleware(['peran:SUPERADMIN,DAERAH'])->prefix('laporan/daerah')->name('laporan.daerah.')->group(function () {
    //     Route::get('/kegiatan-rutin', [LaporanKegiatanGenerus::class, 'rutinDaerah'])
    //         ->name('rutin');

    //     Route::get('/kegiatan-event', [LaporanKegiatanGenerus::class, 'eventDaerah'])
    //         ->name('event');
    // });

    // =========================
    // LAPORAN KELOMPOK
    // =========================
    // Route::middleware(['peran:SUPERADMIN,KELOMPOK'])->prefix('laporan/kelompok')->name('laporan.kelompok.')->group(function () {
    //     Route::get('/kegiatan-rutin', [LaporanKegiatanGenerus::class, 'rutinKelompok'])
    //         ->name('rutin');

    //     Route::get('/kegiatan-event', [LaporanKegiatanGenerus::class, 'eventKelompok'])
    //         ->name('event');
    // });

    // sistem
    Route::get('/sistem/profil-pengguna',  [SistemController::class, 'profil_pengguna'])->name('sistem.profil-pengguna');
    Route::get('/sistem/akses-pengguna',  [SistemController::class, 'akses_pengguna'])->name('sistem.akses-pengguna');
    Route::get('/sistem/template-pesan',  [SistemController::class, 'template_pesan'])->name('sistem.template-pesan');
});