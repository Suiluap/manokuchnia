<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Recipe;
use App\Models\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'username',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function recipes() {
        return $this->hasMany(Recipe::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function isUser() {
        return $this->role->id == '1';
    }

    public function isAdmin(){
        return $this->role->id == '2';
    }
}
