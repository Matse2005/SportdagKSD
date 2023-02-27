<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\PermissionRegistrar;
use App\Http\Controllers\RegistrationsController;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'class',
        'password',
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

    public function registrations()
    {
        return $this->belongsTo(Registrations::class);
    }

    public function discussed()
    {
        return $this->belongsTo(Discussed::class);
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }

    // public function assignRole($role)
    // {
    //     return $this->roles()->attach($role);
    // }
}
