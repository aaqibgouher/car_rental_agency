<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingModel extends Model
{
    protected $table = "bookings";

    public function user(){
        return $this->belongsTo(UserModel::class, "user_id");
    }

    public function car(){
        return $this->belongsTo(CarModel::class, "car_id");
    }
}
