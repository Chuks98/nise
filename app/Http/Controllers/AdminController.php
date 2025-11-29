<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Handle admin login.
     */
    public function loginAdmin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            $admin = Admin::where('username', $request->username)->first();

            if (!$admin) {
                Log::warning("Login attempt failed: username '{$request->username}' does not exist.");
                return response()->json(['message' => 'Username does not exist'], 401);
            }

            if (!Hash::check($request->password, $admin->password)) {
                Log::warning("Login attempt failed: incorrect password for username '{$request->username}'.");
                return response()->json(['message' => 'Incorrect password'], 401);
            }

            // Store session data with role
            Session::put('loggedIn', true);
            Session::put('user', [
                'id' => $admin->id,
                'username' => $admin->username,
                'role' => 'admin',
            ]);
            Session::put('last_activity', now());

            Log::info("Admin '{$admin->username}' logged in successfully.");

            return response()->json(['message' => 'Login successful']);

        } catch (\Exception $e) {
            Log::error("Login error for username '{$request->username}': " . $e->getMessage());
            return response()->json(['message' => '❌ Login error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update admin password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|min:6',
        ]);

        try {
            $admin = Admin::where('username', 'admin')->first();

            if (!$admin) {
                Log::warning("Password update failed: admin not found.");
                return response()->json(['message' => 'Admin not found'], 404);
            }

            if (!Hash::check($request->currentPassword, $admin->password)) {
                Log::warning("Password update failed: incorrect current password for admin.");
                return response()->json(['message' => 'Current password incorrect'], 403);
            }

            $admin->password = Hash::make($request->newPassword);
            $admin->save();

            Log::info("Admin password updated successfully for '{$admin->username}'.");

            return response()->json(['message' => 'Password updated successfully']);

        } catch (\Exception $e) {
            Log::error("Update password error: " . $e->getMessage());
            return response()->json(['message' => '❌ Update password error: ' . $e->getMessage()], 500);
        }
    }
}
