<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;



    protected $fillable = ['name', 'artists','genre','year','image_path','is_active', 'user_id'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
