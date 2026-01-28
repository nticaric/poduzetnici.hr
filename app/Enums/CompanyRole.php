<?php

namespace App\Enums;

enum CompanyRole: string
{
    case Owner = 'owner';
    case Admin = 'admin';
    case Member = 'member';

    public function label(): string
    {
        return match ($this) {
            self::Owner => 'Vlasnik',
            self::Admin => 'Administrator',
            self::Member => 'Član',
        };
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn (self $role) => [$role->value => $role->label()]
        )->all();
    }

    public function canManageCompany(): bool
    {
        return in_array($this, [self::Owner, self::Admin]);
    }

    public function canDeleteCompany(): bool
    {
        return $this === self::Owner;
    }

    public function canManageMembers(): bool
    {
        return in_array($this, [self::Owner, self::Admin]);
    }
}
