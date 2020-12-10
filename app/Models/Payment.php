<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = ['payment_mathod','discount','status','created_at','updated_at'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
