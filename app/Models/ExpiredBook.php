<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpiredBook extends Model
{
    public $guarded = ['id'];

    public function book(){
        return $this->belongsToMany(Book::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }
}
