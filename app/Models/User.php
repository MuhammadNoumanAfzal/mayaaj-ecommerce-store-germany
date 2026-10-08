<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    /**
     * Check if user has specific role or any of given roles.
     * Super Admin always passes.
     */
    public function hasRole(string|array $roles): bool
    {
        if ($this->role === 'super_admin') {
            return true;
        }

        if (is_string($roles)) {
            $roles = array_map('trim', explode(',', $roles));
        }

        return in_array($this->role, $roles, true);
    }

    /**
     * Check if user is Super Admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if user can operate as Store Admin.
     */
    public function isAdmin(): bool
    {
        return in_array($this->role, ['super_admin', 'admin'], true);
    }

    /**
     * Check if user is a Moderator.
     */
    public function isModerator(): bool
    {
        return in_array($this->role, ['super_admin', 'admin', 'moderator'], true);
    }

    /**
     * Check if user can manage Inventory.
     */
    public function isInventoryManager(): bool
    {
        return in_array($this->role, ['super_admin', 'admin', 'inventory_manager'], true);
    }

    /**
     * Human-readable label for user role.
     */
    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'super_admin'       => 'Super Admin',
            'admin'             => 'Store Admin',
            'moderator'         => 'Review Moderator',
            'inventory_manager' => 'Inventory Staff',
            default             => ucfirst(str_replace('_', ' ', $this->role ?? 'Staff')),
        };
    }

    /**
     * CSS classes for role badge.
     */
    public function getRoleBadgeClassAttribute(): string
    {
        return match ($this->role) {
            'super_admin'       => 'bg-purple-50 text-purple-800 border-purple-200',
            'admin'             => 'bg-rose-50 text-rose-800 border-rose-200',
            'moderator'         => 'bg-blue-50 text-blue-800 border-blue-200',
            'inventory_manager' => 'bg-amber-50 text-amber-800 border-amber-200',
            default             => 'bg-stone-100 text-stone-700 border-stone-200',
        };
    }
}
