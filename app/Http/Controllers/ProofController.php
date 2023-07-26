<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Proof;
use Illuminate\Support\Facades\Storage;

class ProofController extends Controller
{
    public function generate(Sale $sale){
        
         $this->authorize('proofGenerate',$sale);

        return view('proof.proof-generate',compact('sale'));
    }

    public function show(Proof $proof)
    {

        return view('proof.proof-show',compact('proof'));
    }

    public function dowloadXml(Proof $proof){
        $path = $proof->xml;
        return Storage::download($path);
    }

    public function dowloadCdr(Proof $proof){
        $path = $proof->cdr;
        return Storage::download($path);
    }
}
