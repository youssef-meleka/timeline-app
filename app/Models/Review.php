<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define the relationship: a review belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship: a review belongs to a story
    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}
