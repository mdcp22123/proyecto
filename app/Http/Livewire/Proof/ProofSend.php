<?php

namespace App\Http\Livewire\Proof;

use App\Models\Proof;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

use Greenter\Ws\Services\SunatEndpoints;
use Greenter\See;

class ProofSend extends Component
{
    public $proof;
    public $modal=false;
    public $modalresp=false;
    public $respuesta;
    public $observaciones;
    
    public function mount(Proof $proof)
    {
        $this->proof = $proof;
    }

    public function render()
    {
        return view('livewire.proof.proof-send');
    }
    public function generate(){
       
        $this->modal=true;
    }
    public function sendSunat(){
      /*   dd($this->proof->sale->update(['status'=>'3'])); */
        $see = new See();
        $see->setService(SunatEndpoints::FE_BETA);
        $see->setClaveSOL('20000000001', 'MODDATOS', 'moddatos');
        $path = $this->proof->xml;
        $xml=Storage::get($path);
        
        $result = $see->sendXmlFile($xml);

        if (!$result->isSuccess()) {
          // Mostrar error al conectarse a SUNAT.
         /*         echo 'Codigo Error: '.$result->getError()->getCode();
          echo 'Mensaje Error: '.$result->getError()->getMessage(); */
          $error='Codigo Error: '.$result->getError()->getCode() .'-//-Mensaje Error: '.$result->getError()->getMessage();
          $this->emit('error',$error);
          $this->proof->status=1;
          $this->proof->response=$error;
          $this->proof->save();
          $this->emit('error-sunat',$error.'---****ENVIAR MAS TARDE***',$this->proof->id);
         
         /*     dd($result->getError()->getCode()); */
          }else{
              $path_cdr='boletas/'.$this->proof->id.'/R-20123456789-03-B001-'.$this->proof->correlative.'.zip';
              Storage::put($path_cdr,$result->getCdrZip());//Guarda el CDR en la carpeta comprobantes/1/r-factura.zip
                  $this->proof->cdr=$path_cdr;
              // Verificar CDR (Factura aceptada o rechazada)

              $cdr = $result->getCdrResponse();
              $code = (int)$cdr->getCode();

              if ($code === 0) {
                  $this->emit('acept','BOLETA Aceptada');
                  $this->modal=false;
                   $this->modalresp=true;
                   $this->respuesta=$cdr->getDescription();
                   $this->proof->status=2;
                   $this->proof->sale->update(['status'=>'3']);
                   $this->proof->response=$cdr->getDescription();
                   if (count($cdr->getNotes()) > 0) {
                      $this->observaciones=$cdr->getNotes();
                      $this->emit('obs','Aceptada CON OBSERVACIONES - Corregir en futuras facturas');

                  /*     dd($cdr->getNotes()); */
                     /*  $this->respuesta='$cdr->getNotes();
                      $this->observaciones=$cdr->getNotes(); */
                    /*   dd('INCLUYE OBSERVACIONES:'); */
                      // Mostrar observaciones
                      $ob='';
                      foreach ($cdr->getNotes() as $obs){
                          $ob.='-//-'.$obs;
                      } 
                      $this->proof->observation=$ob;
  
                  }
              }
         
              else if ($code >= 2000 && $code <= 3999) {
                $this->proof->status=4;
                $this->proof->response=$cdr->getDescription();
                $this->emit('error-sunat','ESTADO: BOLETA RECHAZADA - EMITIR UNA NUEVA BOLETA',$this->proof->id);

              }else {
                  // Esto no debería darse, pero si ocurre, es un CDR inválido que debería tratarse como un error-excepción.
                  //code: 0100 a 1999 
                  $this->proof->status=5;
                  $this->proof->response=$cdr->getDescription();
                  $this->emit('error-sunat','ESTADO: BOLETA EXCEPCION- Corregir y volver a enviar la factura',$this->proof->id);
              }
           
              $this->proof->save();

        }

    }
    
}
