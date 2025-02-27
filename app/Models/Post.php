<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['mensaje', 'user_id', 'hilo_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hilo()
    {
        return $this->belongsTo(Hilo::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
