<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Propertie extends Model
{
    use HasFactory, Searchable;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'city',
        'price_per_night',
        'max_guest',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
    public function images() {
        return $this->hasMany(Image::class);
    }
    public function searchableAs()
    {
        return 'properties_index'; // Customize the index name if needed
    }

    public function toSearchableArray()
    {
        return [
            // 'id' => $this->id,
            'title' => $this->title,
            'location' => $this->location,
            'city' => $this->city,
            // 'combined_location' => $this->location . ' ' . $this->city,
        ];
    }
}
