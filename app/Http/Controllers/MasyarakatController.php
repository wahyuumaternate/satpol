<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MasyarakatController extends Controller
{

    /**
     * Dashboard utama masyarakat
     */
    public function dashboard()
    {
        $user = Auth::user();

        // Statistik pengaduan user
        $stats = [
            'total' => $user->pengaduans()->count(),
            'menunggu' => $user->pengaduans()->where('status', 'menunggu')->count(),
            'proses' => $user->pengaduans()->where('status', 'proses')->count(),
            'selesai' => $user->pengaduans()->where('status', 'selesai')->count(),
            'ditolak' => $user->pengaduans()->where('status', 'ditolak')->count(),
        ];

        // Pengaduan terbaru (5 terakhir)
        $pengaduanTerbaru = $user->pengaduans()
            ->with(['kelurahan.kecamatan'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Statistik per bulan (6 bulan terakhir)
        $monthlyStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $count = $user->pengaduans()
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $monthlyStats[] = [
                'month' => $date->format('M Y'),
                'count' => $count
            ];
        }

        // Pengaduan berdasarkan kategori
        $kategoriStats = $user->pengaduans()
            ->select('kategori_ketertiban', DB::raw('count(*) as total'))
            ->groupBy('kategori_ketertiban')
            ->get()
            ->mapWithKeys(function ($item) {
                return [str_replace('_', ' ', ucfirst($item->kategori_ketertiban)) => $item->total];
            });

        // Waktu respon rata-rata (dari pengaduan yang sudah ada tanggapan)
        $avgResponseTime = $user->pengaduans()
            ->whereIn('status', ['selesai', 'ditolak'])
            ->whereNotNull('updated_at')
            ->get()
            ->avg(function ($pengaduan) {
                return $pengaduan->created_at->diffInHours($pengaduan->updated_at);
            });

        return view('masyarakat.dashboard', compact(
            'stats',
            'pengaduanTerbaru',
            'monthlyStats',
            'kategoriStats',
            'avgResponseTime'
        ));
    }

    /**
     * Daftar pengaduan user
     */
    public function pengaduan(Request $request)
    {
        $user = Auth::user();
        $query = $user->pengaduans()->with(['kelurahan.kecamatan']);

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_ketertiban', $request->kategori);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_pengaduan', 'like', "%{$search}%")
                    ->orWhere('judul', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $pengaduan = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik untuk filter
        $stats = [
            'menunggu' => $user->pengaduans()->where('status', 'menunggu')->count(),
            'proses' => $user->pengaduans()->where('status', 'proses')->count(),
            'selesai' => $user->pengaduans()->where('status', 'selesai')->count(),
            'ditolak' => $user->pengaduans()->where('status', 'ditolak')->count(),
        ];

        return view('masyarakat.pengaduan.index', compact('pengaduan', 'stats'));
    }

    /**
     * Form buat pengaduan baru
     */
    public function createPengaduan()
    {
        $kecamatans = Kecamatan::where('is_active', true)->get();
        return view('masyarakat.pengaduan.create', compact('kecamatans'));
    }

    /**
     * Store pengaduan baru
     */
    public function storePengaduan(Request $request)
    {
        $validated = $request->validate([
            'kelurahan_id' => 'required|exists:kelurahans,id',
            'lokasi_kejadian' => 'required|string|max:255',
            'alamat_kejadian' => 'required|string',
            'kategori_ketertiban' => 'required|in:keamanan,kebersihan,kebisingan,parkir_liar,pedagang_kaki_lima,vandalisme,lainnya',
            'waktu_kejadian' => 'required|date',
            'nomor_telepon' => 'nullable|string|max:20',
            'judul' => 'required|string|max:200',
            'deskripsi' => 'required|string',
            'foto_bukti' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'setuju' => 'required|accepted'
        ], [
            'kelurahan_id.required' => 'Kelurahan harus dipilih',
            'kategori_ketertiban.required' => 'Kategori ketertiban harus dipilih',
            'waktu_kejadian.required' => 'Waktu kejadian harus diisi',
            'judul.required' => 'Judul pengaduan harus diisi',
            'deskripsi.required' => 'Deskripsi pengaduan harus diisi',
            'foto_bukti.image' => 'File harus berupa gambar',
            'foto_bukti.max' => 'Ukuran file maksimal 2MB',
            'setuju.accepted' => 'Anda harus menyetujui pernyataan kebenaran data'
        ]);

        // Generate kode pengaduan unik
        $kodePrefix = 'CKT-' . date('ymd') . '-';
        $lastPengaduan = Pengaduan::where('kode_pengaduan', 'like', $kodePrefix . '%')
            ->orderBy('kode_pengaduan', 'desc')
            ->first();

        if ($lastPengaduan) {
            $lastNumber = intval(substr($lastPengaduan->kode_pengaduan, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        $kodePengaduan = $kodePrefix . $newNumber;

        // Handle file upload
        $fotoPath = null;
        if ($request->hasFile('foto_bukti')) {
            $fotoPath = $request->file('foto_bukti')->store('pengaduan/foto-bukti', 'public');
        }

        // Create pengaduan
        $pengaduan = Pengaduan::create([
            'user_id' => Auth::id(),
            'kode_pengaduan' => $kodePengaduan,
            'kelurahan_id' => $validated['kelurahan_id'],
            'lokasi_kejadian' => $validated['lokasi_kejadian'],
            'alamat_kejadian' => $validated['alamat_kejadian'],
            'kategori_ketertiban' => $validated['kategori_ketertiban'],
            'waktu_kejadian' => $validated['waktu_kejadian'],
            'nomor_telepon' => $validated['nomor_telepon'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'foto_bukti' => $fotoPath,
            'status' => 'menunggu',
        ]);

        return redirect()
            ->route('masyarakat.pengaduan')
            ->with('success', 'Pengaduan berhasil dikirim dengan kode: ' . $kodePengaduan);
    }

    /**
     * Detail pengaduan
     */
    public function showPengaduan($id)
    {
        $pengaduan = Auth::user()
            ->pengaduans()
            ->with(['kelurahan.kecamatan'])
            ->findOrFail($id);

        return view('masyarakat.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Edit pengaduan (hanya jika status menunggu)
     */
    public function editPengaduan($id)
    {
        $pengaduan = Auth::user()
            ->pengaduans()
            ->where('status', 'menunggu')
            ->findOrFail($id);

        $kecamatans = Kecamatan::where('is_active', true)->get();
        $kelurahans = Kelurahan::where('kecamatan_id', $pengaduan->kelurahan->kecamatan_id)->get();

        return view('masyarakat.pengaduan.edit', compact('pengaduan', 'kecamatans', 'kelurahans'));
    }

    /**
     * Update pengaduan
     */
    public function updatePengaduan(Request $request, $id)
    {
        $pengaduan = Auth::user()
            ->pengaduans()
            ->where('status', 'menunggu')
            ->findOrFail($id);

        $validated = $request->validate([
            'kelurahan_id' => 'required|exists:kelurahans,id',
            'lokasi_kejadian' => 'required|string|max:255',
            'alamat_kejadian' => 'required|string',
            'kategori_ketertiban' => 'required|in:keamanan,kebersihan,kebisingan,parkir_liar,pedagang_kaki_lima,vandalisme,lainnya',
            'waktu_kejadian' => 'required|date',
            'nomor_telepon' => 'nullable|string|max:20',
            'judul' => 'required|string|max:200',
            'deskripsi' => 'required|string',
            'foto_bukti' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('foto_bukti')) {
            // Delete old file
            if ($pengaduan->foto_bukti) {
                Storage::disk('public')->delete($pengaduan->foto_bukti);
            }
            $validated['foto_bukti'] = $request->file('foto_bukti')->store('pengaduan/foto-bukti', 'public');
        }

        $pengaduan->update($validated);

        return redirect()
            ->route('masyarakat.pengaduan')
            ->with('success', 'Pengaduan berhasil diperbarui');
    }

    /**
     * Hapus pengaduan (hanya jika status menunggu)
     */
    public function destroyPengaduan($id)
    {
        $pengaduan = Auth::user()
            ->pengaduans()
            ->where('status', 'menunggu')
            ->findOrFail($id);

        // Delete foto if exists
        if ($pengaduan->foto_bukti) {
            Storage::disk('public')->delete($pengaduan->foto_bukti);
        }

        $pengaduan->delete();

        return redirect()
            ->route('masyarakat.pengaduan')
            ->with('success', 'Pengaduan berhasil dihapus');
    }

    /**
     * Profil user
     */
    public function profile()
    {
        $user = Auth::user();
        return view('masyarakat.profile.index', compact('user'));
    }

    /**
     * Update profil
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nomor_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
        ]);

        $user->update($validated);

        return redirect()
            ->route('masyarakat.profile')
            ->with('success', 'Profil berhasil diperbarui');
    }

    /**
     * Ubah password
     */
    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed',
        ], [
            'current_password.current_password' => 'Password saat ini tidak sesuai',
            'password.min' => 'Password baru minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
        ]);

        Auth::user()->update([
            'password' => bcrypt($validated['password'])
        ]);

        return redirect()
            ->route('masyarakat.profile')
            ->with('success', 'Password berhasil diubah');
    }

    /**
     * Cek status pengaduan (untuk guest)
     */
    public function checkStatus(Request $request)
    {
        $validated = $request->validate([
            'kode_pengaduan' => 'required|string|exists:pengaduans,kode_pengaduan'
        ], [
            'kode_pengaduan.required' => 'Kode pengaduan harus diisi',
            'kode_pengaduan.exists' => 'Kode pengaduan tidak ditemukan'
        ]);

        $pengaduan = Pengaduan::with(['user', 'kelurahan.kecamatan'])
            ->where('kode_pengaduan', $validated['kode_pengaduan'])
            ->first();

        return view('masyarakat.check-status', compact('pengaduan'));
    }

    /**
     * Get kelurahan by kecamatan (AJAX)
     */
    public function getKelurahan(Request $request)
    {
        $validated = $request->validate([
            'kecamatan_id' => 'required|exists:kecamatans,id'
        ]);

        $kelurahans = Kelurahan::where('kecamatan_id', $validated['kecamatan_id'])
            ->where('is_active', true)
            ->select('id', 'nama')
            ->get();

        return response()->json($kelurahans);
    }

    /**
     * Get detail pengaduan (AJAX)
     */
    public function getPengaduanDetail($id)
    {
        $pengaduan = Auth::user()
            ->pengaduans()
            ->with(['user', 'kelurahan.kecamatan'])
            ->findOrFail($id);

        return response()->json($pengaduan);
    }

    /**
     * Dashboard statistik (AJAX)
     */
    public function getStats()
    {
        $user = Auth::user();

        $stats = [
            'total' => $user->pengaduans()->count(),
            'menunggu' => $user->pengaduans()->where('status', 'menunggu')->count(),
            'proses' => $user->pengaduans()->where('status', 'proses')->count(),
            'selesai' => $user->pengaduans()->where('status', 'selesai')->count(),
            'ditolak' => $user->pengaduans()->where('status', 'ditolak')->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Export pengaduan user
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'excel');
        $user = Auth::user();

        $query = $user->pengaduans()->with(['kelurahan.kecamatan']);

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengaduans = $query->orderBy('created_at', 'desc')->get();

        $filename = 'pengaduan-saya-' . date('Y-m-d');

        switch ($format) {
            case 'csv':
                return $this->exportCsv($pengaduans, $filename);
            case 'pdf':
                return $this->exportPdf($pengaduans, $filename);
            default:
                return $this->exportExcel($pengaduans, $filename);
        }
    }

    private function exportCsv($pengaduans, $filename)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '.csv"',
        ];

        $callback = function () use ($pengaduans) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'Kode Pengaduan',
                'Tanggal',
                'Judul',
                'Kategori',
                'Status',
                'Lokasi',
                'Kecamatan',
                'Kelurahan'
            ]);

            foreach ($pengaduans as $pengaduan) {
                fputcsv($file, [
                    $pengaduan->kode_pengaduan,
                    $pengaduan->created_at->format('d/m/Y H:i'),
                    $pengaduan->judul,
                    str_replace('_', ' ', ucfirst($pengaduan->kategori_ketertiban)),
                    ucfirst($pengaduan->status),
                    $pengaduan->lokasi_kejadian,
                    $pengaduan->kelurahan->kecamatan->nama ?? 'N/A',
                    $pengaduan->kelurahan->nama ?? 'N/A'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportExcel($pengaduans, $filename)
    {
        // Implementasi export Excel menggunakan library seperti PhpSpreadsheet
        // Untuk contoh, kita return CSV format
        return $this->exportCsv($pengaduans, $filename);
    }

    private function exportPdf($pengaduans, $filename)
    {
        // Implementasi export PDF menggunakan library seperti DomPDF
        // Untuk contoh, kita return CSV format
        return $this->exportCsv($pengaduans, $filename);
    }
}
