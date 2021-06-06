<?php

namespace App\Models;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'quantity',
        'measurement',
        'recipe_id'
    ];

    public function recipe() {
        return $this->belongsTo(Recipe::class);
    }
}
