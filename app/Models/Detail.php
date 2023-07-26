<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }


}
