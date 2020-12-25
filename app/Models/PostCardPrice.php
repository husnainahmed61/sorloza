<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCardPrice extends Model
{
    use HasFactory;
    protected $table = 'postcardprice';
    protected $fillable = ['price','created_at','updated_at'];
}
