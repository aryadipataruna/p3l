<?php
namespace App\Http\Controllers;

use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenitipController;
use Illuminate\Http\Request;

class RegistrationHandleController extends Controller
{
    /**
     * Handle registration requests based on the selected role.
     */
    public function handleRegistration(Request $request)
    {
        // Basic validation for the role field
        $request->validate([
            'role' => 'required|in:pembeli,penitip,pegawai,organisasi',
        ]);

        $role = $request->role;

        try {
            // Dispatch to appropriate controller's store method based on role
            return match ($role) {
                'pembeli' => app(PembeliController::class)->store($request),
                'penitip' => app(PenitipController::class)->store($request),
                'pegawai' => app(PegawaiController::class)->store($request),
                'organisasi' => app(OrganisasiController::class)->store($request),
                default => response()->json([
                    'status'  => false,
                    'message' => 'Invalid role selected.',
                ], 400)
            };

        } catch (ValidationException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed.',
                'errors'  => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Registration failed.',
                'data'    => $e->getMessage(),
            ], 500);
        }
    }
}
