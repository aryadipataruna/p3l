<?php
namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OwnerController extends Controller
{
    /**
     * Handle the registration of a new owner.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NAMA_OWNER'     => 'required|string|max:255',
            'EMAIL_OWNER'    => 'required|string|email|max:255|unique:owners,EMAIL_OWNER',
            'NOTELP_OWNER'   => 'required|string|max:20',
            'ALAMAT_OWNER'   => 'required|string|max:255',
            'PASSWORD_OWNER' => 'required|string|min:8|confirmed', // 'confirmed' requires a 'PASSWORD_OWNER_confirmation' field
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            Owner::create([
                'NAMA_OWNER'     => $request->input('NAMA_OWNER'),
                'EMAIL_OWNER'    => $request->input('EMAIL_OWNER'),
                'NOTELP_OWNER'   => $request->input('NOTELP_OWNER'),
                'ALAMAT_OWNER'   => $request->input('ALAMAT_OWNER'),
                'PASSWORD_OWNER' => Hash::make($request->input('PASSWORD_OWNER')),
            ]);

            return response()->json(['success' => true, 'message' => 'Berhasil mendaftar sebagai Owner. Silakan masuk.'], 201);

        } catch (\Exception $e) {
            \Log::error('Owner registration failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal mendaftar sebagai Owner. Silakan coba lagi.'], 500);
        }
    }
}
