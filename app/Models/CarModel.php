<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = "cars";

    public function user(){
        return $this->belongsTo(UserModel::class, "user_id");
    }

    public function bookings(){
        return $this->hasMany(BookingModel::class, "car_id");
    }
}
