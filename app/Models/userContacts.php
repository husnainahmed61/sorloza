<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userContacts extends Model
{
    use HasFactory;
    protected $table = 'user_contacts';
    protected $fillable = ['user_id','alias','name','surname','address','population','province','postalCode',
            'created_at','updated_at'
            ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
