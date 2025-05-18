<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Handle the registration of a new administrator.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NAMA_ADMIN'     => 'required|string|max:255',
            'EMAIL_ADMIN'    => 'required|string|email|max:255|unique:admins,EMAIL_ADMIN',
            'NOTELP_ADMIN'   => 'required|string|max:20',
            'ALAMAT_ADMIN'   => 'required|string|max:255',
            'PASSWORD_ADMIN' => 'required|string|min:8|confirmed', // 'confirmed' requires a 'PASSWORD_ADMIN_confirmation' field
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            Admin::create([
                'NAMA_ADMIN'     => $request->input('NAMA_ADMIN'),
                'EMAIL_ADMIN'    => $request->input('EMAIL_ADMIN'),
                'NOTELP_ADMIN'   => $request->input('NOTELP_ADMIN'),
                'ALAMAT_ADMIN'   => $request->input('ALAMAT_ADMIN'),
                'PASSWORD_ADMIN' => Hash::make($request->input('PASSWORD_ADMIN')),
            ]);

            return response()->json(['success' => true, 'message' => 'Berhasil mendaftar sebagai Admin. Silakan masuk.'], 201);

        } catch (\Exception $e) {
            \Log::error('Admin registration failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal mendaftar sebagai Admin. Silakan coba lagi.'], 500);
        }
    }
}
