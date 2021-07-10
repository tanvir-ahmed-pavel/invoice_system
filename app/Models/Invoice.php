<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public function items(){
        return $this->hasMany(Item::class);
    }

    public function preparedBy(){
        return $this->belongsTo(User::class);
    }

}
