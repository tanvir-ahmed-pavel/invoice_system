<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_address',
        'client_contact',
        'client_email',
        'client_website',
        'user_id',
    ];

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function clientHolder(){
        return $this->belongsTo(User::class);
    }




}
