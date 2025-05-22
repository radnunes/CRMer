<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
    ];

    public function userRoles()
    {
        return $this->hasMany(RoleTeamUser::class);
    }

    public function usersCount()
    {
        return $this->userRoles()
            ->select('team_id')
            ->groupBy('team_id')
            ->selectRaw('COUNT(DISTINCT user_id) as count');
    }


}
