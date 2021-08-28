<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_address',
        'company_contact',
        'company_email',
        'company_website',
        'user_id',
    ];

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
