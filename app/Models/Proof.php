<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proof extends Model
{
    
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];
    const PENDIENTE=1;
    const ACEPTADO=2;
    const RECHAZADO=3;
    const EXECEPCION=4;
    const ANULADO=5;
    

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public static  function voucher_type($enum){
        return Proof::where('voucher',$enum)->count();
    }



    public static function typeDocument($enum){
        switch ($enum){
            case 1:
                return 'DNI';
                break;
            case 2:
                return 'RUC';
                break;
            default:
                return 'OTROS';
                break;
        }
    }

  

    public static function typeVoucher($enum){
        switch ($enum){
            case 1:
                return 'BOLETA';
                break;
            case 2:
                return 'FACTURA';
                break;
            case 3:
                return 'TICKET ';
                break;
            default:
                return 'OTROS';
                break;
        }
    }

   
}
