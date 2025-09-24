<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
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

        // Ambil 1 pengaduan dengan status 'proses'
        $pengaduanProses = Pengaduan::with('kelurahan.kecamatan')
            ->where('status', 'proses')
            ->whereNotNull('tanggapan')  // Pastikan ada tanggapan
            ->latest()
            ->first();

        // Ambil 1 pengaduan dengan status 'selesai'
        $pengaduanSelesai = Pengaduan::with('kelurahan.kecamatan')
            ->where('status', 'selesai')
            ->whereNotNull('tanggapan')  // Pastikan ada tanggapan
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
        $validator = Validator::make($request->all(), [
            'kelurahan_id' => 'required|exists:kelurahans,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori_ketertiban' => 'required|in:keamanan,kebersihan,kebisingan,parkir_liar,pedagang_kaki_lima,vandalisme,lainnya',
            'lokasi_kejadian' => 'required|string|max:255',
            'waktu_kejadian' => 'required|date',
            'nama_pelapor' => 'required|string|max:255',
            'email_pelapor' => 'nullable|email|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat_pelapor' => 'required|string',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except(['foto_bukti']);


        // Set status default
        $data['status'] = 'menunggu';

        if ($request->hasFile('foto_bukti')) {
            $foto = $request->file('foto_bukti');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $path = $foto->storeAs('public/foto_bukti', $namaFoto);
            $data['foto_bukti'] = $namaFoto;
        }

        $pengaduan = Pengaduan::create($data);

        // Kirim email konfirmasi jika email pelapor tersedia
        if ($pengaduan->email_pelapor) {
            // Mail::to($pengaduan->email_pelapor)->send(new PengaduanSubmitted($pengaduan));
        }

        return redirect()->route('pengaduan.form', ['kode' => $pengaduan->kode_pengaduan]);
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

        $pengaduan = Pengaduan::with('kelurahan.kecamatan')
            ->where('kode_pengaduan', $request->kode_pengaduan)
            ->firstOrFail();

        return view('frontend.pengaduan.status', compact('pengaduan'));
    }

    /**
     * Menampilkan history pengaduan (opsional - jika dibutuhkan)
     */
    public function history(Request $request)
    {
        // Validasi parameter pencarian email/nomor telepon
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:nomor_telepon|nullable|email',
            'nomor_telepon' => 'required_without:email|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('pengaduan.cek-status')
                ->withErrors($validator)
                ->withInput();
        }

        $query = Pengaduan::query();

        if ($request->filled('email')) {
            $query->where('email_pelapor', $request->email);
        }

        if ($request->filled('nomor_telepon')) {
            $query->where('nomor_telepon', $request->nomor_telepon);
        }

        $pengaduans = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('frontend.pengaduan.history', compact('pengaduans'));
    }
}
