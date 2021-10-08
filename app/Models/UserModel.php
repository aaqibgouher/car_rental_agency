<?php

namespace App\Models;

use App\Models\CarModel;
use App\Models\BookingModel;
use App\Models\UserTokenModel;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "users";
    protected $hidden = ["password"];

    public function tokens(){
        return $this->hasMany(UserTokenModel::class, "user_id");
    }

    public function cars(){
        return $this->hasMany(CarModel::class, "user_id");
    }

    public function bookings(){
        return $this->hasMany(BookingModel::class, "user_id");
    }
}
