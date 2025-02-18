<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    use HasFactory;
     protected $fillable = [
        'UserId', // Add any other fields you want to allow mass assignment for
        // other fields...
    ];
}