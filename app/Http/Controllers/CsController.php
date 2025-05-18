<?php
namespace App\Http\Controllers;

use App\Models\Cs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CsController extends Controller
{
    /**
     * Handle the registration of a new customer service (CS) user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NAMA_CS'     => 'required|string|max:255',
            'EMAIL_CS'    => 'required|string|email|max:255|unique:cs,EMAIL_CS',
            'NOTELP_CS'   => 'required|string|max:20',
            'ALAMAT_CS'   => 'required|string|max:255',
            'PASSWORD_CS' => 'required|string|min:8|confirmed', // 'confirmed' requires a 'PASSWORD_CS_confirmation' field
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            Cs::create([
                'NAMA_CS'     => $request->input('NAMA_CS'),
                'EMAIL_CS'    => $request->input('EMAIL_CS'),
                'NOTELP_CS'   => $request->input('NOTELP_CS'),
                'ALAMAT_CS'   => $request->input('ALAMAT_CS'),
                'PASSWORD_CS' => Hash::make($request->input('PASSWORD_CS')),
            ]);

            return response()->json(['success' => true, 'message' => 'Berhasil mendaftar sebagai CS. Silakan masuk.'], 201);

        } catch (\Exception $e) {
            \Log::error('CS registration failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal mendaftar sebagai CS. Silakan coba lagi.'], 500);
        }
    }
}
