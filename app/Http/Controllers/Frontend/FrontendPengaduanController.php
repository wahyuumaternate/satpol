<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FrontendPengaduanController extends Controller
{
    /**
     * Menampilkan halaman form pengaduan
     */
    public function form()
    {
        $kelurahans = Kelurahan::with('kecamatan')->get();
        $kecamatans = Kecamatan::all();

        // Ambil 1 pengaduan dengan status 'proses' yang memiliki tanggapan
        $pengaduanProses = Pengaduan::with(['kelurahan.kecamatan', 'tanggapan'])
            ->where('status', 'proses')
            ->whereHas('tanggapan') // Pastikan ada tanggapan
            ->latest()
            ->first();

        // Ambil 1 pengaduan dengan status 'selesai' yang memiliki tanggapan
        $pengaduanSelesai = Pengaduan::with(['kelurahan.kecamatan', 'tanggapan'])
            ->where('status', 'selesai')
            ->whereHas('tanggapan') // Pastikan ada tanggapan
            ->latest()
            ->first();

        return view('frontend.pengaduan.form', compact(
            'kelurahans',
            'kecamatans',
            'pengaduanProses',
            'pengaduanSelesai'
        ));
    }

    /**
     * Mendapatkan kelurahan berdasarkan kecamatan (untuk dropdown dinamis)
     */
    public function getKelurahan(Request $request)
    {
        $kelurahans = Kelurahan::where('kecamatan_id', $request->kecamatan_id)->get();
        return response()->json($kelurahans);
    }

    /**
     * Menyimpan pengaduan baru dari frontend
     */
    public function store(Request $request)
    {
        // Validasi apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu untuk membuat pengaduan.');
        }

        $validator = Validator::make($request->all(), [
            'kelurahan_id' => 'required|exists:kelurahans,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori_ketertiban' => 'required|in:keamanan,kebersihan,kebisingan,parkir_liar,pedagang_kaki_lima,vandalisme,lainnya',
            'lokasi_kejadian' => 'required|string|max:255',
            'alamat_kejadian' => 'required|string',
            'waktu_kejadian' => 'required|date',
            'nomor_telepon' => 'nullable|string|max:15',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'setuju' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except(['foto_bukti', 'setuju']);

        // Tambahkan user_id dari user yang sedang login
        $data['user_id'] = Auth::id();

        // Set status default
        $data['status'] = 'menunggu';

        if ($request->hasFile('foto_bukti')) {
            $foto = $request->file('foto_bukti');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $path = $foto->storeAs('public/foto_bukti', $namaFoto);
            $data['foto_bukti'] = $namaFoto;
        }

        $pengaduan = Pengaduan::create($data);

        return redirect()->route('pengaduan.sukses', ['kode' => $pengaduan->kode_pengaduan])
            ->with('success', 'Pengaduan berhasil dikirim. Kode pengaduan Anda adalah: ' . $pengaduan->kode_pengaduan);
    }

    /**
     * Menampilkan halaman sukses setelah submit pengaduan
     */
    public function success(Request $request)
    {
        if (!$request->kode) {
            return redirect()->route('pengaduan.form');
        }

        $pengaduan = Pengaduan::where('kode_pengaduan', $request->kode)->firstOrFail();

        return view('frontend.pengaduan.success', compact('pengaduan'));
    }

    /**
     * Halaman untuk cek status pengaduan
     */
    public function cekStatus()
    {
        return view('frontend.pengaduan.cek-status');
    }

    /**
     * Proses pengecekan status
     */
    public function prosesStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_pengaduan' => 'required|exists:pengaduans,kode_pengaduan',
        ], [
            'kode_pengaduan.required' => 'Kode pengaduan tidak boleh kosong',
            'kode_pengaduan.exists' => 'Kode pengaduan tidak ditemukan'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pengaduan = Pengaduan::with(['kelurahan.kecamatan', 'tanggapan.petugas'])
            ->where('kode_pengaduan', $request->kode_pengaduan)
            ->firstOrFail();

        return view('frontend.pengaduan.status', compact('pengaduan'));
    }

    /**
     * Menampilkan history pengaduan untuk user yang sudah login
     */
    public function history()
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login untuk melihat riwayat pengaduan.');
        }

        $pengaduans = Pengaduan::where('user_id', Auth::id())
            ->with(['kelurahan', 'tanggapan'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.pengaduan.history', compact('pengaduans'));
    }
}
