<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Proof;
use App\Models\Sale;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GeneratePdf extends Controller
{
    public function box(Box $box){
        $pdf = Pdf::setPaper( [0, 0,204.094,1000])->loadView('pdf.ticket-box', ['box'=>$box/* , 'qr'=>$qr */ ]);
        return $pdf->stream();  
    }
    public function boxUlt(Box $box){
    $pdf = Pdf::setPaper( [0, 0,204.094,1000])->loadView('pdf.ticket-box-ult', ['box'=>$box/* , 'qr'=>$qr */ ]);
    return $pdf->stream(); 
    }
    public function boletaA4(Proof $proof)
    {   
        $fecha=$proof->created_at->format('d/m/Y');
        $qr='1098456123|'.$proof->serie.'|'.$proof->correlative.'|'.round($proof->sale->tax,2).'|'.round($proof->sale->total,2).'|'.$fecha;

     $pdf = Pdf::loadView('pdf.boleta-a4' , ['proof'=>$proof ,'qr'=>$qr ]);
     return $pdf->stream();   
    }
    public function boletaTicket(Proof $proof)
    {
        $fecha=$proof->created_at->format('d/m/Y');
        $qr='1098456123|'.$proof->serie.'|'.$proof->correlative.'|'.round($proof->sale->tax,2).'|'.round($proof->sale->total,2).'|'.$fecha;
        $pdf = Pdf::setPaper( [0, 0,280,1000])->loadView('pdf.boleta-ticket', ['proof'=>$proof, 'qr'=>$qr ]);
        return $pdf->stream();   
       /*     $items=json_decode($sale->contenido);
           return view('proof.proof-pdf-ticket',compact('sale','items','qr') );*/
       }

       public function ticketSale(Sale $sale)
       {
        $fecha=$sale->created_at->format('d/m/Y');
/*         $qr='1098456123|T001|'.str_pad($sale->id, 7, "0", STR_PAD_LEFT)
        .'|'.round($sale->tax,2).'|'.round($sale->total,2).'|'.$fecha; */
        $pdf = Pdf::setPaper( [0, 0,204.094,1000])->loadView('pdf.ticket-sale', ['sale'=>$sale/* , 'qr'=>$qr */ ]);
       return $pdf->stream();  
       }

       public function donwloadBoletaA4(Proof $proof)
    {
   
        $fecha=$proof->created_at->format('d/m/Y');
        $qr='1098456123|'.$proof->serie.'|'.$proof->correlative.'|'.round($proof->sale->tax,2).'|'.round($proof->sale->total,2).'|'.$fecha;
   
        $pdf = Pdf::loadView('pdf.boleta-a4' , ['proof'=>$proof ,'qr'=>$qr ]);
     return $pdf->download($proof->serie.'-'.$proof->correlative.'.pdf');
    }

 
}
