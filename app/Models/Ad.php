<?php

namespace App\Models;

use App\Enums\AdStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'images',
        'price',
        'type',
        'category',
        'duration_days',
        'expires_at',
        'is_anonymous',
        'views_count',
        'location',
        'status',
        'rejection_reason',
        'reviewed_at',
        'reviewed_by',
        'annual_revenue',
        'net_profit',
        'established_year',
        'employee_count',
        'includes_real_estate',
        'website',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'price' => 'decimal:2',
        'annual_revenue' => 'decimal:2',
        'net_profit' => 'decimal:2',
        'includes_real_estate' => 'boolean',
        'images' => 'array',
        'status' => AdStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function scopeActive($query)
    {
        return $query->where('expires_at', '>', now())
            ->where('status', AdStatus::Approved);
    }

    public function scopePending($query)
    {
        return $query->where('status', AdStatus::Pending);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', AdStatus::Approved);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', AdStatus::Rejected);
    }

    public function isPending(): bool
    {
        return $this->status === AdStatus::Pending;
    }

    public function isApproved(): bool
    {
        return $this->status === AdStatus::Approved;
    }

    public function isRejected(): bool
    {
        return $this->status === AdStatus::Rejected;
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function approve(User $reviewer): void
    {
        $this->update([
            'status' => AdStatus::Approved,
            'rejection_reason' => null,
            'reviewed_at' => now(),
            'reviewed_by' => $reviewer->id,
        ]);
    }

    public function reject(User $reviewer, string $reason): void
    {
        $this->update([
            'status' => AdStatus::Rejected,
            'rejection_reason' => $reason,
            'reviewed_at' => now(),
            'reviewed_by' => $reviewer->id,
        ]);
    }
}
