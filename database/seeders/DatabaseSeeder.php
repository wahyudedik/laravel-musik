<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Tenant::checkCurrent()
            ? $this->runTenantSpecificSeeders()
            : $this->runLandlordSpecificSeeders();
    }

    public function runTenantSpecificSeeders()
    {
        // Kosong untuk saat ini, tidak perlu membuat data tenant dulu
        echo "Tenant seeder ran, but no data was created as requested.\n";
    }

    public function runLandlordSpecificSeeders()
    {
        echo "Creating users for testing login...\n";
        
        try {
            // Reset data yang ada untuk pengujian
            if (!app()->environment('production')) {
                Schema::disableForeignKeyConstraints();
                if (Schema::hasTable('tenant_users')) {
                    DB::table('tenant_users')->truncate();
                }
                if (Schema::hasTable('tenants')) {
                    DB::table('tenants')->truncate();
                }
                if (Schema::hasTable('users')) {
                    DB::table('users')->truncate();
                }
                Schema::enableForeignKeyConstraints();
            }
            
            // Buat user untuk setiap role
            $superAdmin = User::factory()->create([
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('password'),
                'user_type' => 'super_admin'
            ]);
            
            $admin = User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'user_type' => 'admin'
            ]);
            
            $composer = User::factory()->create([
                'name' => 'Composer User',
                'email' => 'composer@gmail.com',
                'password' => Hash::make('password'),
                'user_type' => 'composer'
            ]);
            
            $creator = User::factory()->create([
                'name' => 'Cover Creator',
                'email' => 'creator@gmail.com',
                'password' => Hash::make('password'),
                'user_type' => 'cover_creator'
            ]);
            
            $artist = User::factory()->create([
                'name' => 'Official Artist',
                'email' => 'artist@gmail.com',
                'password' => Hash::make('password'),
                'user_type' => 'official_artist'
            ]);
            
            // Buat tenant untuk setiap user tenant 
            echo "Creating tenants with path-based approach...\n";
            
            // Untuk Composer
            $composerName = 'Composer User';
            $composerPathId = strtolower(str_replace([' ', '.', '_'], '-', $composerName));
            
            try {
                $composerTenant = Tenant::create([
                    'name' => $composerName,
                    'domain' => config('app.url'), // Gunakan domain utama
                    'path_id' => $composerPathId, // Tambahkan path_id untuk identifikasi di URL
                    'database' => 'composer_' . $composerPathId,
                ]);
                $composerTenant->vendorUsers()->attach($composer);
                echo "Created composer tenant successfully (path: /{$composerPathId})\n";
            } catch (\Exception $e) {
                echo "Error creating composer tenant: " . $e->getMessage() . "\n";
            }
            
            // Untuk Cover Creator
            $creatorName = 'Cover Creator';
            $creatorPathId = strtolower(str_replace([' ', '.', '_'], '-', $creatorName));
            
            try {
                $creatorTenant = Tenant::create([
                    'name' => $creatorName,
                    'domain' => config('app.url'), // Gunakan domain utama
                    'path_id' => $creatorPathId, // Tambahkan path_id untuk identifikasi di URL
                    'database' => 'cover_creator_' . $creatorPathId,
                ]);
                $creatorTenant->vendorUsers()->attach($creator);
                echo "Created cover creator tenant successfully (path: /{$creatorPathId})\n";
            } catch (\Exception $e) {
                echo "Error creating cover creator tenant: " . $e->getMessage() . "\n";
            }
            
            // Untuk Official Artist
            $artistName = 'Official Artist';
            $artistPathId = strtolower(str_replace([' ', '.', '_'], '-', $artistName));
            
            try {
                $artistTenant = Tenant::create([
                    'name' => $artistName,
                    'domain' => config('app.url'), // Gunakan domain utama
                    'path_id' => $artistPathId, // Tambahkan path_id untuk identifikasi di URL
                    'database' => 'official_artist_' . $artistPathId,
                ]);
                $artistTenant->vendorUsers()->attach($artist);
                echo "Created official artist tenant successfully (path: /{$artistPathId})\n";
            } catch (\Exception $e) {
                echo "Error creating official artist tenant: " . $e->getMessage() . "\n";
            }
            
            echo "Users and tenants created successfully!\n";
        } catch (\Exception $e) {
            echo "Error in seeder: " . $e->getMessage() . "\n";
        }
    }
}