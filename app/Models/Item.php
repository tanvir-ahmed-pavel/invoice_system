<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'quantity',
        'unit',
        'rate',
        'amount',
    ];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
