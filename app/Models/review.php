<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory;
    public function reviewed_user()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
