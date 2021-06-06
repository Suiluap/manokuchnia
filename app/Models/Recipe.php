<?php

namespace App\Models;

use App\Models\Step;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'portions',
        'category_id',
        'user_id'
    ];

    public function ownedBy(User $user) {
        return $user->id == $this->user_id;
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function ingredients() {
        return $this->hasMany(Ingredient::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function steps() {
        return $this->hasMany(Step::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
