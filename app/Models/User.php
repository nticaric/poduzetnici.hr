<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\CompanyRole;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'role',
        'account_type',
        'company_name',
        'company_type',
        'industry',
        'oib',
        'phone',
        'preferred_contact_method',
        'google_id',
        'facebook_id',
        'avatar',
        'slug',
        'is_public',
        'description',
        'address',
        'web',
        'current_company_id',
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
            'is_public' => 'boolean',
            'role' => UserRole::class,
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin;
    }

    public function isUser(): bool
    {
        return $this->role === UserRole::User;
    }

    public function ads(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Ad::class);
    }

    public function receivedMessages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    public function sentMessages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function unreadMessagesCount(): int
    {
        return $this->receivedMessages()->unread()->count();
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    public function currentCompany(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'current_company_id');
    }

    public function ownedCompanies(): BelongsToMany
    {
        return $this->companies()
            ->wherePivot('role', CompanyRole::Owner->value);
    }

    public function setCurrentCompany(?Company $company): void
    {
        if ($company && ! $this->companies()->where('company_id', $company->id)->exists()) {
            return;
        }

        $this->update(['current_company_id' => $company?->id]);
    }

    public function hasCompany(Company $company): bool
    {
        return $this->companies()->where('company_id', $company->id)->exists();
    }

    public function companyRole(Company $company): ?CompanyRole
    {
        $pivot = $this->companies()->where('company_id', $company->id)->first()?->pivot;

        if (! $pivot) {
            return null;
        }

        return CompanyRole::tryFrom($pivot->role);
    }
}
