<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $guarded = ['id'];

    public function author(){
        return $this->belongsTo(User::class);
    }

    public function rents(){
        return $this->hasMany(Rent::class);
    }

    public function expiredBooks(){
        return $this->hasMany(ExpiredBook::class);
    }
}
