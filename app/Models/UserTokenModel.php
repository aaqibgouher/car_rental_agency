<?php

namespace App\Models;

use App\Models\UserModel;
use Illuminate\Database\Eloquent\Model;

class UserTokenModel extends Model
{
    protected $table = "user_tokens";

    public function user(){
        return $this->belongsTo(UserModel::class, "user_id");
    }
}
