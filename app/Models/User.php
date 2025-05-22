<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    // Roles on a specific team, via your 3-way pivot table
    public function rolesOnTeam(Team $team)
    {
        return $this->belongsToMany(Role::class, 'role_team_user')
            ->wherePivot('team_id', $team->id)
            ->withTimestamps();
    }

    // All role_team_user records related to this user
    public function teamRoles()
    {
        return $this->hasMany(RoleTeamUser::class);
    }

    // Check if user has a specific role on a given team
    public function hasRoleOnTeam(string $roleName, Team $team): bool
    {
        return $this->rolesOnTeam($team)->where('name', $roleName)->exists();
    }

    public function hasRoleOnAnyTeam(string $roleName): bool
    {
        return $this->teamRoles()->whereHas('role', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })->exists();
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin();
    }


}
