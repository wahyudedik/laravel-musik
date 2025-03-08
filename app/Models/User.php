<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, UsesLandlordConnection;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type', // composer, cover_creator, official_artist, admin, super_admin
        'is_active', // 1 = aktif, 0 = tidak aktif
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function tenantUsers()
    {
        return $this->belongsToMany(Tenant::class, 'tenant_users');
    }

    public function isLandlordUser(): bool
    {
        return in_array($this->user_type, ['admin', 'super_admin']);
    }

    public function isTenantUser(): bool
    {
        return in_array($this->user_type, ['composer', 'cover_creator', 'official_artist']);
    }
}
