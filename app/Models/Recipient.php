<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;
    protected $table = 'recipients';
    protected $fillable = ['recipients_name','message','created_at','updated_at'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
