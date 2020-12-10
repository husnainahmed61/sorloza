<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address'; 
    protected $fillable = ['postal_address','shipping_address','created_at','updated_at'];

    public function order(){
    	return $this->belongsTo(Order::class);
    }
}
