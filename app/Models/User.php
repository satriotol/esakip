<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'opd_id',
        'last_signin_at',
        'last_ip_address',
        'uuid'
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
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }
    public function scopeNotRole(Builder $query, $roles, $guard = null): Builder
    {
        if ($roles instanceof Collection) {
            $roles = $roles->all();
        }

        if (!is_array($roles)) {
            $roles = [$roles];
        }

        $roles = array_map(function ($role) use ($guard) {
            if ($role instanceof Role) {
                return $role;
            }

            $method = is_numeric($role) ? 'findById' : 'findByName';
            $guard = $guard ?: $this->getDefaultGuardName();

            return $this->getRoleClass()->{$method}($role, $guard);
        }, $roles);

        return $query->whereHas('roles', function ($query) use ($roles) {
            $query->where(function ($query) use ($roles) {
                foreach ($roles as $role) {
                    $query->where(config('permission.table_names.roles') . '.id', '!=', $role->id);
                }
            });
        });
    }
    public static function getOpdUsers()
    {
        if (Auth::user()->opd_id) {
            $getOpdUsers = User::where('email', '!=', 'satriotol69@gmail.com')->has('opd')->where('opd_id', Auth::user()->opd_id)->get();
        } else {
            $getOpdUsers = User::where('email', '!=', 'satriotol69@gmail.com')->has('opd')->get();
        }
        return $getOpdUsers;
    }
    public static function getUsers()
    {
        if (Auth::user()->email == 'satriotol69@gmail.com') {
            $users = User::whereNull('opd_id')->get();
        } else {
            $users = User::notRole(['SUPERADMIN'])->whereNull('opd_id')->get();
        }
        return $users;
    }

    public static function getUserRole()
    {
        $user = Auth::user();
        return $user->getRoleNames()->first() ?? '-';
    }

    public static function getRoles()
    {
        $user = Auth::user();
        if ($user->getUserRole($user) != 'SUPERADMIN') {
            return Role::where('name', '!=', 'SUPERADMIN')->get();
        } else {
            return Role::all();
        }
    }
}
