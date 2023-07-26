<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];
    protected $dates = ['opening', 'closing'];
    const ABIERTO=1;
    const CERRADO=2;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function motions()
    {
        return $this->hasMany(Motion::class);
    }
    


}
