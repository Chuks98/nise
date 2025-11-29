<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminInitServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            if (\Schema::hasTable('admins')) {
                $existing = Admin::where('username', 'admin')->first();

                if (!$existing) {
                    Admin::create([
                        'username' => 'admin',
                        'password' => Hash::make('admin54321'),
                    ]);

                    \Log::info('✅ Default admin created.');
                } else {
                    \Log::info('ℹ️ Admin already exists.');
                }
            } else {
                \Log::warning('⚠️ Admins table does not exist. Skipping default admin creation.');
            }
        } catch (\Throwable $e) {
            \Log::error('❌ Error initializing default admin: ' . $e->getMessage());
        }
    }

}
