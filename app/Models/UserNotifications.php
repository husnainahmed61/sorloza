<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotifications extends Model
{
    use HasFactory;
    protected $table = 'user_notifications';
    protected $fillable = ['notification_id','user_id','is_read','created_at','updated_at'];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function notification(){
        return $this->hasOne(Notifications::class);
    }
}
