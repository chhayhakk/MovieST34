<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    // Review.php (Review model)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movies::class, 'movie_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected $fillable = [
        'title_review',
        'rate',
        'movie_id',
        'user_id',
        'content',
        'created_at',
        'updated_at',
      
    ];
}
