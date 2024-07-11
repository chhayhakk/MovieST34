<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;
    
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'movie_id');
        
    }
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rate');
    }
    public function genre()
    {
        return $this->belongsTo(Genres::class, 'genre_id');
    }
    protected $table = 'movies';
    protected $fillable = [
        'title',
        'description',
        'duration',
        'year',
        'image_path',
        'release',
        'quality',
        'type',
        'back_photo',
        'genre_id',
        'user_id'
    ];
}
