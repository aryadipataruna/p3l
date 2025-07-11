<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Import Str facade for string manipulation
use Carbon\Carbon;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Barang::all();

            return response()->json([
                "status" => true,
                "message" => "Getting all Barang successful!",
                "data" => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Getting all Barang failed!!!",
                "data" => $e->getMessage()
            ], 400);
        }
    }

    public function produkTerjual()
    {
        try {
            $data = Barang::where('status', 'terjual')->get();

            // Check if any items with 'terjual' status were found
            if ($data->isEmpty()) {
                 return response()->json([
                    "status" => false,
                    "message" => "No sold items found.",
                    "data" => [] // Return an empty array if no sold items exist
                ], 404); // Use 404 Not Found if no sold items are found
            }

            
            return response()->json([
                "status" => true,
                "message" => "Getting all Barang successful!",
                "data" => $data
            ], 500);
            

        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Getting all Barang failed!!!",
                "data" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate incoming request data, exclude id_barang as it will be generated
            $validateData = $request->validate([
                'id_penitip' => 'required|string', // NOT NULL in DB
                'id_diskusi' => 'nullable|string', // NULL in DB
                'id_pegawai' => 'required|string', // NOT NULL in DB
                'nama_barang' => 'required|string', // NOT NULL in DB
                'deskripsi_barang' => 'required|string', // NOT NULL in DB
                'kategori' => 'required|string', // NOT NULL in DB
                'harga_barang' => 'required|numeric', // NOT NULL in DB
                'tgl_titip' => 'required|date', // NOT NULL in DB
                'tgl_laku' => 'nullable|date', // NULL in DB
                'garansi' => 'required|boolean', // NOT NULL in DB (tinyint)
                'perpanjangan' => 'nullable|boolean', // NOT NULL in DB (tinyint)
                'count_perpanjangan' => 'nullable|integer', // NOT NULL in DB
                'status' => 'nullable|string', // NULL in DB
                'bukti_pembayaran' => 'nullable|string', // NOT NULL in DB
            ]);

             // Generate unique id_barang (e.g., BAR001, BAR002, ...)
            // Find the last Barang record to get the highest ID number
            $lastBarang = Barang::orderBy('id_barang', 'desc')->first();

            // Extract the numeric part from the last ID, or start with 0 if no records exist
            // Assumes ID format is BAR + 3 digits
            $lastIdNumber = $lastBarang ? (int) substr($lastBarang->id_barang, 3) : 0;

            // Increment the number for the new ID
            $nextIdNumber = $lastIdNumber + 1;

            // Format the new ID with the prefix 'BAR' and pad with leading zeros to 3 digits
            $generatedId = 'BAR' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);

            $barang->tgl_titip = Carbon::now()->toDateString(); // Tanggal hari ini
            $barang->tgl_akhir = Carbon::now()->addDays(30)->toDateString(); // Tanggal titip + 30 hari
            $barang->perpanjangan = false; // Inisialisasi
            $barang->count_perpanjangan = 0; // Inisialisasi

            // Buat instance Barang baru dan set ID yang di-generate dan data lainnya
            $barang = new Barang($validateData); // Isi atribut lain menggunakan mass assignment
            $barang->id_barang = $generatedId; // Set primary key yang di-generate

            $barang->save(); // Simpan model ke database


            return response()->json([
                "status" => true,
                "message" => "Barang successfully created!",
                "data" => $barang,
            ], 201); // Use 201
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Failed at creating the Barang!",
                "data" => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = Barang::find($id);

            if (!$data) {
                return response()->json(['message' => 'Barang ID not found!!!'], 404);
            }

            return response()->json([
                "status" => true,
                "message" => "Getting the selected Barang successful!",
                "data" => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Getting the selected Barang failed!!!",
                "data" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = Barang::find($id);

            if (!$data) {
                return response()->json(['message' => 'Barang ID not found!!!'], 404);
            }

            $validateData = $request->validate([
                'id_penitip' => 'required|string',
                'id_diskusi' => 'nullable|string',
                'id_pegawai' => 'required|string',
                'nama_barang' => 'required|string',
                'deskripsi_barang' => 'required|string',
                'kategori' => 'required|string',
                'harga_barang' => 'required|numeric',
                'tgl_titip' => 'required|date',
                'tgl_laku' => 'nullable|date',
                'garansi' => 'required|boolean',
                'perpanjangan' => 'nullable|boolean',
                'count_perpanjangan' => 'nullable|integer',
                'status' => 'nullable|string',
                'bukti_pembayaran' => 'nullable|string',
            ]);

            $data->update($validateData);

            return response()->json([
                "status" => true,
                "message" => "Barang successfully updated!",
                "data" => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Failed at updating the Barang!!!",
                "data" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = Barang::find($id);

            if (!$data) {
                return response()->json(['message' => 'Barang ID not found!!!'], 404);
            }

            $data->delete();

            return response()->json([
                "status" => true,
                "message" => "Successfully deleted the Barang!",
                "data" => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Failed to delete the Barang!!!",
                "data" => $e->getMessage()
            ], 400);
        }
    }

    public function extend(Request $request, $id)
    {
        try {
            $barang = Barang::findOrFail($id);

            $today = Carbon::now()->toDateString(); // Tanggal hari ini (YYYY-MM-DD)
            $tglAkhirBarang = Carbon::parse($barang->tgl_akhir)->toDateString(); // Tanggal akhir barang

            // Cek apakah tgl_akhir barang sama dengan hari ini
            if ($tglAkhirBarang !== $today) {
                return response()->json([
                    'status' => false,
                    'message' => 'Perpanjangan hanya bisa dilakukan pada tanggal akhir titip (hari ini).'
                ], 400); // Bad Request
            }

            // Cek apakah perpanjangan maksimal sudah tercapai (2 kali)
            if ($barang->count_perpanjangan >= 2) {
                return response()->json([
                    'status' => false,
                    'message' => 'Perpanjangan maksimal sudah tercapai (2 kali).'
                ], 400); // Bad Request
            }

            // Update consignment details
            $barang->count_perpanjangan += 1;
            $barang->perpanjangan = true; // Tandai bahwa barang telah diperpanjang
            $barang->tgl_akhir = Carbon::parse($tglAkhirBarang)->addDays(30)->toDateString(); // Perpanjang 30 hari dari tgl_akhir sebelumnya

            $barang->save();

            return response()->json([
                'status' => true,
                'message' => 'Masa titip barang berhasil diperpanjang! (Perpanjangan ke-' . $barang->count_perpanjangan . ')',
                'data' => $barang
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memperpanjang masa titip: ' . $e->getMessage()
            ], 500); // Internal Server Error
        }
    }
}