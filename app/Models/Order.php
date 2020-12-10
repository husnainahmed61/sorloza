<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
     protected $fillable = ['user_id','payment_id','address_id','price','img','created_at','updated_at'];
    public function payment(){
    	return $this->hasOne(Payment::class);
    }

    public function user(){
     return $this->hasOne(User::class);
    }

    public function address(){
     return $this->hasOne(Address::class);
    }
}
