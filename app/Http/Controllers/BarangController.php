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
                'perpanjangan' => 'required|boolean', // NOT NULL in DB (tinyint)
                'count_perpanjangan' => 'required|integer', // NOT NULL in DB
                'status' => 'nullable|string', // NULL in DB
                'bukti_pembayaran' => 'required|string', // NOT NULL in DB
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

            // Hitung tgl_akhir (tgl_titip + 7 hari)
            // Pastikan tgl_titip adalah instance Carbon atau gunakan Carbon::parse()
            $tglTitip = Carbon::parse($validateData['tgl_titip']);
            $tglAkhir = $tglTitip->addDays(7)->toDateString(); // Ambil hanya tanggal

            // Buat instance Barang baru dan set ID yang di-generate dan data lainnya
            $barang = new Barang($validateData); // Isi atribut lain menggunakan mass assignment
            $barang->id_barang = $generatedId; // Set primary key yang di-generate
            $barang->tgl_akhir = $tglAkhir; // Set tgl_akhir yang dihitung
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
                'perpanjangan' => 'required|boolean',
                'count_perpanjangan' => 'required|integer',
                'status' => 'nullable|string',
                'bukti_pembayaran' => 'required|string',
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
}