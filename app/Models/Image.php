<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'propertie_id',
        'image'
    ];
    public function propertie() {
        return $this->belongsTo(Propertie::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
