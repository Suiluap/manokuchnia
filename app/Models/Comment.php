<?php

namespace App\Models;

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'user_id',
        'recipe_id'
    ];

    public function ownedBy(User $user) {
        return $user->id == $this->user_id;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function recipe() {
        return $this->belongsTo(Recipe::class);
    }
}
