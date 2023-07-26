<?php

namespace App\Policies;

use App\Models\Proof;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
{
    use HandlesAuthorization;

    public function saleEdit(?User $user,Sale $sale)
    {
        $condition=Proof::where('sale_id',$sale->id)->exists();
        if($sale->status==1 && !$condition){
            return true;
        }else{
            return false;
        }
    }

    public function proofGenerate(?User $user,Sale $sale)
    {   $condition=Proof::where('sale_id',$sale->id)->exists();

             if($sale->status==1 && !$condition){
                return true;
            }else
            {
                return false;
            }    
       /*      return !$condition; */
                         
    }

  
}
