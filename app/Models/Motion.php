<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motion extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];
    const INGRESO=1;
    const EGRESO=2;

    public function box()
    {
        return $this->belongsTo(Box::class);
    }
}
