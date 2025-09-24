<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengaduanController extends Controller
{
    /**
     * Display a listing of pengaduan for admin
     */
    public function index(Request $request)
    {
        try {
            // Query dasar dengan relasi
            $query = Pengaduan::with(['kelurahan']);

            // Filter berdasarkan status jika ada
            if ($request->has('status') && $request->status != '') {
                $query->where('status', $request->status);
            }

            // Filter berdasarkan kategori jika ada
            if ($request->has('kategori') && $request->kategori != '') {
                $query->where('kategori_ketertiban', $request->kategori);
            }

            // Filter berdasarkan kelurahan jika ada
            if ($request->has('kelurahan') && $request->kelurahan != '') {
                $query->where('kelurahan_id', $request->kelurahan);
            }

            // Filter berdasarkan tanggal jika ada
            if ($request->has('start_date') && $request->start_date != '') {
                $query->whereDate('created_at', '>=', $request->start_date);
            }

            if ($request->has('end_date') && $request->end_date != '') {
                $query->whereDate('created_at', '<=', $request->end_date);
            }

            // Urutkan berdasarkan yang terbaru
            $pengaduans = $query->latest()->get();

            // Statistik pengaduan
            $statistik = [
                'menunggu' => Pengaduan::where('status', 'menunggu')->count(),
                'proses' => Pengaduan::where('status', 'proses')->count(),
                'selesai' => Pengaduan::where('status', 'selesai')->count(),
                'ditolak' => Pengaduan::where('status', 'ditolak')->count(),
            ];

            // Total pengaduan
            $statistik['total'] = array_sum($statistik);

            // Statistik per kategori
            $statistikKategori = Pengaduan::select('kategori_ketertiban', DB::raw('count(*) as total'))
                ->groupBy('kategori_ketertiban')
                ->pluck('total', 'kategori_ketertiban')
                ->toArray();

            // Data untuk filter dropdown
            $kelurahans = Kelurahan::orderBy('nama')->get();

            return view('backend.pengaduan.index', compact(
                'pengaduans',
                'statistik',
                'statistikKategori',
                'kelurahans'
            ));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data pengaduan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified pengaduan detail for admin
     */
    public function show($id)
    {
        try {
            $pengaduan = Pengaduan::with(['kelurahan', 'kecamatan'])->findOrFail($id);

            return response()->json([
                'id' => $pengaduan->id,
                'kode_pengaduan' => $pengaduan->kode_pengaduan,
                'judul' => $pengaduan->judul,
                'deskripsi' => $pengaduan->deskripsi,
                'kategori_ketertiban' => $pengaduan->kategori_ketertiban,
                'lokasi_kejadian' => $pengaduan->lokasi_kejadian,
                'waktu_kejadian' => $pengaduan->waktu_kejadian,
                'nama_pelapor' => $pengaduan->nama_pelapor,
                'email_pelapor' => $pengaduan->email_pelapor,
                'nomor_telepon' => $pengaduan->nomor_telepon,
                'alamat_pelapor' => $pengaduan->alamat_pelapor,
                'foto_bukti' => $pengaduan->foto_bukti,
                'status' => $pengaduan->status,
                'tanggapan' => $pengaduan->tanggapan,
                'tanggal_tanggapan' => $pengaduan->tanggal_tanggapan,
                'kelurahan' => $pengaduan->kelurahan ? [
                    'id' => $pengaduan->kelurahan->id,
                    'nama' => $pengaduan->kelurahan->nama
                ] : null,
                'kecamatan' => $pengaduan->kecamatan ? [
                    'id' => $pengaduan->kecamatan->id,
                    'nama' => $pengaduan->kecamatan->nama
                ] : null,
                'created_at' => $pengaduan->created_at,
                'updated_at' => $pengaduan->updated_at
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Pengaduan tidak ditemukan: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update tanggapan pengaduan
     */
    public function tanggapan(Request $request, $id)
    {
        try {
            $request->validate([
                'tanggapan' => 'required|string|max:1000',
                'status' => 'required|in:proses,selesai,ditolak'
            ]);

            $pengaduan = Pengaduan::findOrFail($id);

            $pengaduan->update([
                'tanggapan' => $request->tanggapan,
                'status' => $request->status,
                'tanggal_tanggapan' => Carbon::now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Tanggapan berhasil disimpan'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan tanggapan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update status pengaduan
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:menunggu,proses,selesai,ditolak'
            ]);

            $pengaduan = Pengaduan::findOrFail($id);

            $pengaduan->update([
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diubah'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Status tidak valid'
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get dashboard statistics for admin
     */
    public function getDashboardStats()
    {
        try {
            $stats = [
                'total' => Pengaduan::count(),
                'menunggu' => Pengaduan::where('status', 'menunggu')->count(),
                'proses' => Pengaduan::where('status', 'proses')->count(),
                'selesai' => Pengaduan::where('status', 'selesai')->count(),
                'ditolak' => Pengaduan::where('status', 'ditolak')->count(),
                'bulan_ini' => Pengaduan::whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->count(),
                'minggu_ini' => Pengaduan::whereBetween('created_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ])->count(),
            ];

            return response()->json($stats);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal memuat statistik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get pengaduan by kelurahan for filtering
     */
    public function getByKelurahan($kelurahan_id)
    {
        try {
            $pengaduans = Pengaduan::where('kelurahan_id', $kelurahan_id)
                ->with(['kelurahan', 'kecamatan'])
                ->latest()
                ->get();

            return response()->json($pengaduans);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal memuat data pengaduan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get pengaduan statistics by kategori
     */
    public function getStatsByKategori()
    {
        try {
            $stats = Pengaduan::select(
                'kategori_ketertiban',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status = "menunggu" THEN 1 ELSE 0 END) as menunggu'),
                DB::raw('SUM(CASE WHEN status = "proses" THEN 1 ELSE 0 END) as proses'),
                DB::raw('SUM(CASE WHEN status = "selesai" THEN 1 ELSE 0 END) as selesai'),
                DB::raw('SUM(CASE WHEN status = "ditolak" THEN 1 ELSE 0 END) as ditolak')
            )
                ->groupBy('kategori_ketertiban')
                ->get();

            return response()->json($stats);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal memuat statistik kategori: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export pengaduan data (optional)
     */
    public function export(Request $request)
    {
        try {
            $query = Pengaduan::with(['kelurahan', 'kecamatan']);

            // Apply filters
            if ($request->has('status') && $request->status != '') {
                $query->where('status', $request->status);
            }

            if ($request->has('kategori') && $request->kategori != '') {
                $query->where('kategori_ketertiban', $request->kategori);
            }

            if ($request->has('kelurahan') && $request->kelurahan != '') {
                $query->where('kelurahan_id', $request->kelurahan);
            }

            if ($request->has('start_date') && $request->start_date != '') {
                $query->whereDate('created_at', '>=', $request->start_date);
            }

            if ($request->has('end_date') && $request->end_date != '') {
                $query->whereDate('created_at', '<=', $request->end_date);
            }

            $pengaduans = $query->latest()->get();

            // Return as JSON for now - you can implement Excel/PDF export here
            return response()->json([
                'data' => $pengaduans,
                'total' => $pengaduans->count(),
                'message' => 'Data berhasil diekspor'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal mengekspor data: ' . $e->getMessage()
            ], 500);
        }
    }
}
