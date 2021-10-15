<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'invoice_signature',
        'invoice_type',
        'subject',
        'car_details',
        'tax',
        'vat',
        'sub_total',
        'net_amount',
        'advance_paid',
        'date',
        'discount'
    ];

    public function items(){
        return $this->hasMany(Item::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function driver(){
        return $this->belongsTo(Driver::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function scopeSearch($query, $s_f_query){
        $s_f_query="%$s_f_query%";
        $query->where(function ($query) use ($s_f_query){
            $query->where("id", "like", $s_f_query)
                ->orWhere("invoice_number", "like", $s_f_query)
                ->orWhere("invoice_type", "like", $s_f_query)
                ->orWhere("car_details", "like", $s_f_query)
                ->orWhere("tax", "like", $s_f_query)
                ->orWhere("vat", "like", $s_f_query)
                ->orWhere("sub_total", "like", $s_f_query)
                ->orWhere("net_amount", "like", $s_f_query)
                ->orWhere("discount", "like", $s_f_query)
                ->orWhere("advance_paid", "like", $s_f_query)
                ->orWhere("date", "like", $s_f_query)
                ->orWhereHas("user", function ($query) use ($s_f_query){
                    $query->where("name", "like", $s_f_query);
                })
                ->orWhereHas("items", function ($query) use ($s_f_query){
                    $query->where("description", "like", $s_f_query);
                })
                ->orWhereHas("driver", function ($query) use ($s_f_query){
                    $query->where("name", "like", $s_f_query);
                })
                ->orWhereHas("client", function ($query) use ($s_f_query){
                    $query->where("client_name", "like", $s_f_query);
                })
                ->orWhereHas("company", function ($query) use ($s_f_query){
                    $query->where("company_name", "like", $s_f_query);
                });
        });
    }


}
