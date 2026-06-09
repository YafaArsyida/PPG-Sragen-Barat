<?php

namespace App\Http\Livewire\Administrasi\KegiatanGenerus;

use App\Models\Kegiatan;
use App\Models\KegiatanGenerus;
use App\Models\TemplatePesanGenerus;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Detail extends Component
{
    public $kegiatan;

    protected $listeners = [
        'KegiatanDetail'
    ];

    public function KegiatanDetail($kegiatanId)
    {
        $this->kegiatan = KegiatanGenerus::with([
            'ms_desa',
            'ms_kelompok.ms_desa'
        ])->find($kegiatanId);

        if (!$this->kegiatan) {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Data kegiatan tidak ditemukan'
            ]);
            return;
        }

        // Siapkan label hari rutin
        if ($this->kegiatan->tipe_kegiatan === 'rutin' && is_array($this->kegiatan->hari_rutin)) {
            $listHari = [
                'senin'  => 'Senin',
                'selasa' => 'Selasa',
                'rabu'   => 'Rabu',
                'kamis'  => 'Kamis',
                'jumat'  => 'Jumat',
                'sabtu'  => 'Sabtu',
                'minggu' => 'Minggu',
            ];
            $this->kegiatan->hari_rutin_label = collect($this->kegiatan->hari_rutin)
                ->map(fn($h) => $listHari[$h] ?? $h)
                ->implode(', ');
        } else {
            $this->kegiatan->hari_rutin_label = null;
        }
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Detail kegiatan ditampilkan'
        ]);
    }

    public function kegiatanPengumuman($kegiatanId)
    {
        $this->dispatchBrowserEvent('alertify-success', [
            'message' => 'Pengumuman sedang disiapkan...'
        ]);

        $kegiatan = KegiatanGenerus::with([
            'ms_desa',
            'ms_kelompok.ms_desa'
        ])->find($kegiatanId);

        if (!$kegiatan) {
            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Data kegiatan tidak ditemukan'
            ]);
            return;
        }

        // =========================
        // TARGET PENERIMA
        // =========================
        if ($kegiatan->scope === 'daerah') {

            $target = "Semua Remaja/i se-Daerah";
        } elseif ($kegiatan->scope === 'desa') {
            $target = "Semua Remaja/i se-Desa "
                . ($kegiatan->ms_desa->nama_desa ?? '-');
        } elseif ($kegiatan->scope === 'kelompok') {

            $target = "Semua Remaja/i Kelompok "
                . ($kegiatan->ms_kelompok->nama_kelompok ?? '-')
                . "\n(Desa "
                . ($kegiatan->ms_kelompok->ms_desa->nama_desa ?? '-')
                . ")";
        } else {
            $target = "Seluruh Remaja/i";
        }

        // =========================
        // TEMPLATE DESA
        // =========================
        $template = null;

        if ($kegiatan->scope === 'desa' && !empty($kegiatan->ms_desa_id)) {
            $template = TemplatePesanGenerus::where('ms_desa_id', $kegiatan->ms_desa_id)->first();
        }

        $judul = $template->judul
            ?? 'UNDANGAN KEGIATAN GENERUS';

        $salamPembuka = $template->salam_pembuka
            ?? "Assalamu'alaikum Wr. Wb.";

        $kalimatPembuka = $template->kalimat_pembuka
            ?? "Mengharap kehadiran Saudara/Saudari pada kegiatan berikut:";

        $kalimatPenutup = $template->kalimat_penutup
            ?? "Kami berharap seluruh peserta dapat hadir tepat waktu dan berpartisipasi dalam infaq fisabilillah. Atas perhatian dan kehadirannya kami ucapkan terima kasih. Jazakumullahu Khairan.";

        $salamPenutup = $template->salam_penutup
            ?? "Wassalamu'alaikum Wr. Wb.";

        // =========================
        // FORMAT TANGGAL
        // =========================
        $tanggal = \App\Http\Controllers\HelperController::formatTanggalIndonesia(
            $kegiatan->tanggal,
            'd F Y'
        );

        // =========================
        // PESAN
        // =========================
        $pesan = '';

        $pesan .= "*{$judul}*\n\n";

        $pesan .= "Kepada:\n";
        $pesan .= "{$target}\n\n";

        $pesan .= $salamPembuka . "\n\n";

        $pesan .= $kalimatPembuka . "\n\n";

        $pesan .= "*{$kegiatan->nama_kegiatan}*\n";
        $pesan .= "Hari, Tanggal : " . $tanggal . "\n";
        $pesan .= "Waktu :" . ($kegiatan->waktu ?: 'Belum ditentukan') . "\n\n";

        $pesan .= "*".($kegiatan->lokasi_final['tempat'] ?? '-') ."*\n";

        if (!empty($kegiatan->lokasi_final['alamat'])) {
            $pesan .= $kegiatan->lokasi_final['alamat'] . "\n";
        }

        if (!empty($kegiatan->lokasi_final['peta'])) {
            $pesan .= "\n";
            $pesan .= $kegiatan->lokasi_final['peta'] . "\n";
        }

        if (!empty($kegiatan->deskripsi)) {
            $pesan .= "\n";
            $pesan .= trim($kegiatan->deskripsi) . "\n";
        }

        $pesan .= "\n";
        $pesan .= $kalimatPenutup;

        $pesan .= $salamPenutup;

        // =========================
        // USER LOGIN
        // =========================
        $user = Auth::user();

        if (!$user || empty($user->telepon)) {

            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Nomor WhatsApp akun Anda belum diatur'
            ]);

            return;
        }

        $telepon = preg_replace('/[^0-9]/', '', $user->telepon);

        if (str_starts_with($telepon, '0')) {
            $telepon = '62' . substr($telepon, 1);
        }

        if (!str_starts_with($telepon, '62')) {

            $this->dispatchBrowserEvent('alertify-error', [
                'message' => 'Format nomor WhatsApp akun tidak valid'
            ]);

            return;
        }

        $url = "https://wa.me/{$telepon}?text=" . urlencode($pesan);

        $this->emit('openNewTab', $url);
    }

    public function render()
    {
        return view('livewire.administrasi.kegiatan-generus.detail');
    }
}
