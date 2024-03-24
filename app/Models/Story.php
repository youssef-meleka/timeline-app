<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define the relationship: a story belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship: a story has many reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
