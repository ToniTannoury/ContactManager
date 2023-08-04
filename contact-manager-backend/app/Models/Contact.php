<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', "image",'phone_number', 'latitude', 'longitude'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
