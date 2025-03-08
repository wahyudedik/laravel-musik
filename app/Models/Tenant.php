<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Spatie\Multitenancy\Models\Tenant as ModelsTenant;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;

class Tenant extends ModelsTenant
{
    use UsesLandlordConnection;

    protected $table = 'tenants';

    protected $guarded = [];

    // Dalam model Tenant
    public function getDatabaseName(): string
    {
        return $this->database;
    }

    protected static function booted(): void
    {
        static::creating(function (Tenant $tenant) {
            $sanitizedDbName = str_replace([' ', '-'], '_', $tenant->database);
            $sanitizedDbName = preg_replace('/[^A-Za-z0-9_]/', '', $sanitizedDbName);
            $query = "CREATE DATABASE IF NOT EXISTS `{$sanitizedDbName}`";
            DB::statement($query);
            $tenant->database = $sanitizedDbName;
        });

        static::created(function (Tenant $tenant) {
            Artisan::call('tenants:artisan "migrate --database=tenant"');
        });
    }

    public function vendorUsers()
    {
        return $this->belongsToMany(User::class, 'tenant_users');
    }
}
