<?php

namespace App\Http\Livewire\Proof;

use App\Models\Proof;
use App\Models\Sale;
use Livewire\Component;

/* facturacion*/
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Client\Client;
use Greenter\Model\Company\Address;
use Greenter\Model\Company\Company;
use Greenter\Model\Sale\Invoice;
use Greenter\See;
use Greenter\Ws\Reader\XmlReader;
use Greenter\Ws\Services\SunatEndpoints;
use Illuminate\Support\Facades\Storage;
use Greenter\Model\Sale\Legend;
class ProofGenerate extends Component
{
    public $modal=false;
    public $modalresp=false;
    public $respuesta;
    public $observaciones;
    public $sale;
    public $correlative;
    public $customer;
    public $number;
    public $address;
    public $proof_id;

    protected $listeners = ['customerSearch'];

    public function mount(Sale $sale)
    {
        $this->sale = $sale;
        $aux = Proof::count();
        $aux=str_pad($aux+1, 7, "0", STR_PAD_LEFT);
        $this->correlative=$aux;
        $this->customer = $sale->patient->name.' '.$sale->patient->surname;
        $this->number = $sale->patient->number;

        $this->proof_id=0;

    }

    public function render()
    {
        return view('livewire.proof.proof-generate');
    }

    public function customerFrecuent(){
        $this->customer = 'Cliente en Tienda';
        $this->number = '00000000';
        $this->address = '-';
    }

    public function customerSearch($name,$number){
        $this->customer = $name;
        $this->number = $number;
        $this->address = '';


    }

    public function generate(){
        $this->validate([
            'correlative' => 'required',
            'customer' => 'required',
            'number' => 'required',
            'address' => 'required',
        ]);
        $this->modal=true;
    }

    public function sendSunat(){


        $proof= new Proof();
        $proof->name=$this->customer;
        $proof->number=$this->number;
        $proof->voucher=1;
        $proof->serie='B001';
        $proof->correlative=$this->correlative;
        $proof->address=$this->address;
        $proof->sale_id=$this->sale->id;


        $aux = Proof::count();
        $aux=$aux+1;

        $path=Storage::path('cert\prive-pub-keys.pem');
        $see = new See();
        $see->setCertificate(file_get_contents($path));
        $see->setService(SunatEndpoints::FE_BETA);
        $see->setClaveSOL('20000000001', 'MODDATOS', 'moddatos');

        $client = new Client();
        $client->setTipoDoc('1')
            ->setNumDoc($this->number)
            ->setRznSocial($this->customer);


        // Emisor
        $address = (new Address())
        ->setUbigueo('150101')
        ->setDepartamento('PUNO')
        ->setProvincia('PUNO')
        ->setDistrito('PUNO')
        ->setUrbanizacion('-')
        ->setDireccion('JR: Lima 123')
        ->setCodLocal('0000'); // Codigo de establecimiento asignado por SUNAT, 0000 por defecto.

        $company = (new Company())
        ->setRuc('20123456789')
        ->setRazonSocial('Centro Medico San Jose EIRL')
        ->setNombreComercial('Centro Medico San Jose')
        ->setAddress($address);



        $invoice = (new Invoice())
        ->setUblVersion('2.1')
        ->setTipoOperacion('0101') // Catalog. 51
        ->setTipoDoc('03')
        ->setSerie('B001')
        ->setCorrelativo($this->correlative)
        ->setFechaEmision(now())
        ->setTipoMoneda('PEN')
        ->setClient($client)
        ->setMtoOperGravadas(number_format(round($this->sale->net,2),2)) //gravadas NETO TOTAL DE TODA LA VENTA
        ->setValorVenta(number_format(round($this->sale->net,2),2)) //GRAVADAS NETO DE TODA LA VENTE NETO SIN INGV SOLO GRAVADAS

        ->setMtoIGV(number_format(round($this->sale->tax,2),2)) //IMPUEST0  TOTAL DE TODA LA VENTA
        ->setTotalImpuestos(number_format(round($this->sale->tax,2),2)) // IMPUEST0 TOTAL DE TODA LA VENTA
     
        ->setSubTotal(number_format(round($this->sale->subtotal,2),2)) //GRAVADAS NETO + IMPUESTO = PRECIO FINAL DE TODA LA VENTA 
        ->setMtoImpVenta(number_format(round($this->sale->subtotal,2),2)) //PRECIO FINAL DE TODA LA VENTA/ GRAVA + INGV IAGUAL QUE ARRIIBA
        ->setCompany(($company));

        $details=[];
            foreach ($this->sale->details as $detail) {
                $item = new SaleDetail();
                $item->setCodProducto('C023')
                    ->setUnidad('NIU')
                    ->setCantidad($detail->quantity)
                    ->setDescripcion($detail->name.'-'.$detail->description) 

                         //unitarios 
                    ->setMtoValorUnitario($detail->net_u) //PRECIO UNITARIO DE PRIDUCTO SIN IMPUESTO (GRAVADS IGV) POR UNIDAD SIN MULTIPLICAR POR LA CANTIDAD  // con todas los decimales
                    ->setMtoPrecioUnitario(number_format(round($detail->price_u,2),2))// PRECIO INITARIO , INCLUIDO  IGV DEL ITEM O PRODUCTO --  NO TOMAR EN CUANTA LA CANTIDAD SOLO 1 UNIDAD 

                             //totales 
                    ->setMtoBaseIgv(number_format(round($detail->net_t,2),2)) // PRECIO BASE NETO SIN IMPUESTO DEL ITEM O PRODUCTO TENIENDO EN CUENTA LA CANTIDAD  
                    ->setMtoValorVenta(number_format(round($detail->net_t,2),2)) //GRAVADA , NETO  - ICLUTYENDO LAS CANTIDADES   DEL ITEM O  PRODUCTO 
                    ->setPorcentajeIgv(18.00) // 18% / PORCENTAJE DE IMPUESTO
                    
                    ->setIgv(number_format(round($detail->tax_t,2),2)) // IMPUESTO/IGV TOTAL DEL ITEM O PRODUCTO TENIENDO EN CUENTA LA CANTIDAD
                    ->setTotalImpuestos(number_format(round($detail->tax_t,2),2))// IGV TOTAL DEL PRODUCTO O ITEM TENIENDO EN CUENTA LA CANTIDAD 
                    ->setTipAfeIgv('10');
                    $details[]=$item;
            }

            
       /*      $item2 = new SaleDetail();
            $item2->setCodProducto('C025')
                ->setCodProducto('rou0014')
                ->setUnidad('NIU')
                ->setCantidad(1)
                ->setDescripcion('PRODUCTO 11')
                //unitarios 
                ->setMtoValorUnitario(127.1186440678) //PRECIO UNITARIO DE PRIDUCTO SIN IMPUESTO (GRAVADS IGV) POR UNIDAD SIN MULTIPLICAR POR LA CANTIDAD // con todas los decimales
                ->setMtoPrecioUnitario(151.00)// PRECIO INITARIO , INCLUIDO  IGV DEL ITEM O PRODUCTO --  NO TOMAR EN CUANTA LA CANTIDAD SOLO 1 UNIDAD 

                //totales 
                ->setMtoBaseIgv(127.11) // PRECIO BASE NETO SIN IMPUESTO DEL ITEM O PRODUCTO TENIENDO EN CUENTA LA CANTIDAD  
                ->setMtoValorVenta(122.12) //GRAVADA , NETO  - ICLUTYENDO LAS CANTIDADES   DEL ITEM O  PRODUCTO 
                ->setPorcentajeIgv(18.00) // 18% / PORCENTAJE DE IMPUESTO
              
                ->setIgv(22.88) // IMPUESTO/IGV TOTAL DEL ITEM O PRODUCTO TENIENDO EN CUENTA LA CANTIDAD
                ->setTotalImpuestos(22.88)// IGV TOTAL DEL PRODUCTO O ITEM TENIENDO EN CUENTA LA CANTIDAD 
                ->setTipAfeIgv('10');

                $invoice->setDetails([$item2]); */
                $invoice->setDetails($details);
            $legend = new Legend();
            $legend->setCode('1000')
                ->setValue(convertNumberToText(number_format(round($this->sale->total,2),2)).' NUEVOS SOLES');
                $invoice->setLegends([$legend]);
/*                 dd($invoice); */

                $xml=$see->getXmlSigned($invoice);
              $path_xml='boletas/'.$aux.'/'.$invoice->getName().'.xml';

             Storage::put($path_xml,$xml);  
             $proof->xml=$path_xml;

              $result = $see->send($invoice);

              $parser = new XmlReader();
              $documento = $parser->getDocument($xml);
              $hash = $documento->getElementsByTagName('DigestValue')->item(0)->nodeValue;

              $proof->hash=$hash;

              if (!$result->isSuccess()) {
                // Mostrar error al conectarse a SUNAT.
        /*         echo 'Codigo Error: '.$result->getError()->getCode();
                echo 'Mensaje Error: '.$result->getError()->getMessage(); */
                $error='Codigo Error: '.$result->getError()->getCode() .'-//-Mensaje Error: '.$result->getError()->getMessage();
                
                $proof->status=1;
                $proof->response=$error;
                $proof->save();
                $this->emit('error-sunat',$error.'---****ENVIAR MAS TARDE Y/O CORREGIR ERRORES***',$proof->id);
               
            /*     dd($result->getError()->getCode()); */
                }else{
                    $path_cdr='boletas/'.$aux.'/R-'.$invoice->getName().'.zip';
                    Storage::put($path_cdr,$result->getCdrZip());//Guarda el CDR en la carpeta comprobantes/1/r-factura.zip
                        $proof->cdr=$path_cdr;
                    
                    // Verificar CDR (Factura aceptada o rechazada)

                    $cdr = $result->getCdrResponse();
                    $code = (int)$cdr->getCode();

                    if ($code === 0) {
                        $this->emit('acept','BOLETA Aceptada');
                        $this->modal=false;
                         $this->modalresp=true;
                         $this->respuesta=$cdr->getDescription();
                         $proof->status=2;
                         $this->sale->update(['status'=>'3']);
                         $proof->response=$cdr->getDescription();
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
                            $proof->observation=$ob;
        
                        }
                    }
               
                    else if ($code >= 2000 && $code <= 3999) {
                        $proof->status=3;
                        $proof->response=$cdr->getDescription();
                        $this->emit('error-sunat','ESTADO: BOLETA RECHAZADA - EMITIR UNA NUEVA BOLETA',$proof->id);
                        

                    }else {
                        // Esto no debería darse, pero si ocurre, es un CDR inválido que debería tratarse como un error-excepción.
                        //code: 0100 a 1999 
                        $proof->status=4;
                        $proof->response=$cdr->getDescription();
                        $this->emit('error-sunat','ESTADO: BOLETA EXCEPCION- Corregir y volver a enviar la BOLETA',$proof->id);
                        
                    }
                 
                    $proof->save();
                    $this->proof_id=$proof->id;
                }
       

        
    }

    public function dsd()
    {
        if ($code === 0) {

            /*        dd('Factura Aceptada');  */
                  $this->emit('acept','BOLETA Aceptada');
                  $this->modal=false;
                  $this->modalresp=true;
                  $this->respuesta=$cdr->getDescription();
        
                   if (count($cdr->getNotes()) > 0) {
                      $this->observaciones=$cdr->getNotes();
                      $this->emit('obs','Aceptada CON OBSERVACIONES');
                  /*     dd($cdr->getNotes()); */
                     /*  $this->respuesta='$cdr->getNotes();
                      $this->observaciones=$cdr->getNotes(); */
                    /*   dd('INCLUYE OBSERVACIONES:'); */
                      // Mostrar observaciones
                     /*  foreach ($cdr->getNotes() as $obs){
                          $this->observaciones.='/n'.$obs;
                      }  */
                  }
                  else if ($code >= 2000 && $code <= 3999) {
                      $this->emit('error','ESTADO: BOLETA RECHAZADA');
        /*                   dd('ESTADO: RECHAZADA'); */
        
                  } else {
                      // Esto no debería darse, pero si ocurre, es un CDR inválido que debería tratarse como un error-excepción.
                      //code: 0100 a 1999 
               /*        $this->emit('error','ESTADO: BOLETA EXCEPCION'); */
                      dd('Excepción');
                  }
        
              }
    }

}



