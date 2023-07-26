<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];
    const REGISTRADO=1;
    const ANULADO=2;
    const FACTURADO=3;
    
    const LIBRE=1;
    const TERCERO=2;
    

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proof()
    {
        return $this->hasOne(Proof::class);
    }
 
    public function details()
    {
        return $this->hasMany(Detail::class);
    }

  /*   public function scopeSearch($query, $search)
    {
        return $query->whereHas('patient', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
            ->orWhereHas('patient', function ($query) use ($search) {
                $query->where('surname', 'like', '%' . $search . '%');
            })
            ->orWhereHas('patient', function ($query) use ($search) {
                $query->where('number', 'like', '%' . $search . '%');
            });
    }   */ 

    public function type_proof($id){
      /*   $sale=Sale::find($id); */

            switch (/* $sale->proof->voucher */$id) {
                case 1:
                    return 'Boleta';
                    break;
                case 2:
                    return 'Factura';
                    break;
                case 3:
                    return 'Ticket';
                    break;

                default:
                return 'No hay comprobante';
            }   
                   
    }

    public function status($id){
        switch ($id) {
            case 1:
                return 'Registrado';
                break;
            case 2:
                return 'Anulado';
                break;
            case 3:
                return 'Facturado';
                break;
            default:
                return 'No hay comprobante';
        }   
    }

    
    
}
