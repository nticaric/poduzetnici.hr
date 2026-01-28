<?php

namespace App\Models;

use App\Enums\CompanyRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'oib',
        'phone',
        'description',
        'address',
        'web',
        'industry',
        'slug',
        'is_public',
        'avatar',
    ];

    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
        ];
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class);
    }

    public function owner(): ?User
    {
        return $this->users()
            ->wherePivot('role', CompanyRole::Owner->value)
            ->first();
    }

    public function admins(): BelongsToMany
    {
        return $this->users()
            ->wherePivot('role', CompanyRole::Admin->value);
    }

    public function members(): BelongsToMany
    {
        return $this->users()
            ->wherePivot('role', CompanyRole::Member->value);
    }

    public function hasUser(User $user): bool
    {
        return $this->users()->where('user_id', $user->id)->exists();
    }

    public function userRole(User $user): ?CompanyRole
    {
        $pivot = $this->users()->where('user_id', $user->id)->first()?->pivot;

        if (! $pivot) {
            return null;
        }

        return CompanyRole::tryFrom($pivot->role);
    }

    public function userCanManage(User $user): bool
    {
        $role = $this->userRole($user);

        return $role && $role->canManageCompany();
    }

    public function userCanDelete(User $user): bool
    {
        $role = $this->userRole($user);

        return $role && $role->canDeleteCompany();
    }

    public function addUser(User $user, CompanyRole $role = CompanyRole::Member): void
    {
        if (! $this->hasUser($user)) {
            $this->users()->attach($user->id, ['role' => $role->value]);
        }
    }

    public function removeUser(User $user): void
    {
        $this->users()->detach($user->id);
    }

    public function updateUserRole(User $user, CompanyRole $role): void
    {
        $this->users()->updateExistingPivot($user->id, ['role' => $role->value]);
    }
}
