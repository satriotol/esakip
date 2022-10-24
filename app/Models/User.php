<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

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
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
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
}
