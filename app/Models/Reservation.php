<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'propertie_id',
        'name',
        'phone',
        'travelers',
        'startDate',
        'endDate',
    ];

    public function propertie() {
        return $this->belongsTo(Propertie::class);
    }
}
