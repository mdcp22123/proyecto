<?php

namespace App\Http\Livewire\Sale;

use App\Models\Billing;
use App\Models\Box;
use App\Models\Detail;
use App\Models\Motion;
use App\Models\Patient;
use App\Models\Proof;
use App\Models\Sale;
use App\Models\Service;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class SaleCreate extends Component
{
    use AuthorizesRequests;

    public $modal=false;
    public $modalpdf=false;
    public $patient;
    public $aux;
    public $type;
    public $saleId=' ';
    public $service,$qty,$price;
    public $observation;
    public $correlative,$status,$tax,$net,$discount,$total;
    public $name,$number;
    public $serie_correlative;
    public $change,$cash;

    protected $listeners = ['setPatient','patientCreate'/* ,'companySearch' */];

    public function mount()
    {
        Cart::instance('salecreate')->destroy();
        $ticket=Sale::count();     
        $aux=str_pad($ticket+1, 7, "0", STR_PAD_LEFT);
        $this->correlative=$aux;
        $this->serie_correlative='T001-'.$this->correlative;  
        Cart::instance('salecreate')->setGlobalDiscount(0);
        $this->discount='';
        $this->aux=0; 
        $this->type=1;
        $this->status=1;

     
    }
    public  function render()
    {

        $this->authorize('box-asing');
/*         $services=Service::all(); */
    $services=Service::select('id','name','description','price',DB::raw("0 as checked"))
        ->get();
    
        foreach($services as $key => $servicio){
            $cart=Cart::instance('salecreate')->content();
            $item =$cart->where('id',$servicio->id)->first();
            if($item){  
                if(!is_null(Cart::instance('salecreate')->get($item->rowId))){
                                    $servicio->checked=1;                             
                                } 
            }         
                
            } 
        return view('livewire.sale.sale-create',compact('services'))->layout('layouts.app');
    }

    public function serviceAdd()
    {
            $rules=[
                'service'=>'required',
                'price'=>'required|numeric|min:1',
            ];
            $this->validate($rules);
            $item=Service::find($this->service);
            

            Cart::instance('salecreate')->add([
                'id' => $item->id,
                'name' =>  $item->name,
                'qty' => 1,
                'price' =>  $this->price,
                'weight' => 550,
                'options' => [
                    'description' => $item->description,
                    ]
            ]);
            $this->reset([
                'modal',
  
                'price',

           
            ]);
                        $this->service='';
                         $this->emit('success','Agregado correctamente');
                         $this->cash='';
                         $this->change='';
                        Cart::instance('salecreate')->setGlobalDiscount(0);
                        $this->aux=0;
                        $this->discount='';
         
    }

    public function deleteItem($item)
    {
        Cart::instance('salecreate')->setGlobalDiscount(0);
        $this->discount='';
        $this->aux=0;
         Cart::instance('salecreate')->remove($item);   
         $this->cash='';
         $this->change='';    
         $this->emit('success','Item eliminado');
    }

    public function decrementqty($item){
        $row=Cart::instance('salecreate')->get($item);
        if($row->qty==1){
            Cart::instance('salecreate')->remove($row->rowId);
            $this->emit('success','Item eliminado');
        }else{
            Cart::instance('salecreate')->setGlobalDiscount(0);
            $this->discount='';
            $this->aux=0;
            Cart::instance('salecreate')->update($item, $row->qty - 1);
            $this->cash='';
            $this->change='';
            $this->emit('success','Cantidad disminuida');
        }
    }

    public function incrementqty($item){
        $row=Cart::instance('salecreate')->get($item);
        Cart::instance('salecreate')->setGlobalDiscount(0);
        $this->discount='';
        $this->aux=0;
        Cart::instance('salecreate')->update($item, $row->qty + 1);
        $this->cash='';
        $this->change='';
        $this->emit('success','Cantidad aumentada');
    }
    public function updatedType(){
        $this->cash='';
        $this->change='';
       
        Cart::instance('salecreate')->setGlobalDiscount(0);
        $this->aux=0;
        $this->discount='';

    }

    public function setPatient(Patient $patient)
    {
        $this->patient = $patient;
    }
    public function removePatient(){
        $this->patient = null;
    }

    public function patientCreate(Patient $patient)
    {
        $this->patient = $patient;
    }

 /*    public function billingData(){

        if ($this->voucher==1) {
            $boleta=Proof::voucher_type(1);
           
            $aux=str_pad($boleta+1, 6, "0", STR_PAD_LEFT);
          
             $this->correlative=$aux;
            $this->serie='B001';
            $this->serie_correlative=$this->serie.'-'.$this->correlative;  

  
           
        };
         if($this->voucher==2) 
         {
            $factura=Proof::voucher_type(2);
        
            $aux=str_pad($factura+1, 6, "0", STR_PAD_LEFT);
            $this->correlative=$aux;
            $this->serie='F001';
            $this->serie_correlative=$this->serie.'-'.$this->correlative; 
      
        }

        if($this->voucher==3){
            $ticket=Proof::voucher_type(3);
            $aux=str_pad($ticket+1, 6, "0", STR_PAD_LEFT);
            $this->correlative=$aux;
            $this->serie='T001';
            $this->serie_correlative=$this->serie.'-'.$this->correlative;
        }


        if($this->voucher==0){
            $this->serie_correlative='';
        }
    } */


   /*  public function companySearch($name,$number){
        $this->name=$name;
        $this->number=$number;
        }
    public function removeCompany(){
        $this->name=null;
        $this->number=null;
    } */

    public function discount($resp)
    {   
        if($resp==1){
            $this->validate(
                [
                    'discount'=>'required|numeric|min:1|decimal:0',
                ]
                );
            if(Cart::instance('salecreate')->count()==0){
                $this->emit('error','No hay servicios en la lista');
            }else{
                
            
           

            $d=Cart::instance('salecreate')->initial(2)*10;
            $c=floor($d)/10;
            $t=Cart::instance('salecreate')->initial(2)-$c;
            $x=Cart::instance('salecreate')->initial(2)-$t;   
            $y=$this->discount;
            $p=($y*100)/$x;

            if($p>100 || $p<0){
                $this->emit('error','El descuento no puede ser mayor al 100% o menor a 0');
            }else{
              
                Cart::instance('salecreate')->setGlobalDiscount($p);
                $this->aux=$this->discount;
                $this->change='';
                $this->cash='';
                $this->emit('success','Descuento aplicado ');
            }

        }
       /*  Cart::setGlobalDiscount($p);
        $this->change='';
        $this->cash='';
        $this->emit('success','Descuento aplicado');  */ 
        }
        if($resp==0){
            $this->discount='';
            $this->aux=0;
            Cart::instance('salecreate')->setGlobalDiscount(0);
            $this->change='';
            $this->cash='';
            $this->emit('success','Descuento Quitado '); 
        }         
    } 

    public function updatedCash()
    {          
        /*     $d=Cart::instance('salecreate')->total(2)*10;
            $c=floor($d)/10;
            $t=Cart::instance('salecreate')->total(2)-$c; */
            $x=Cart::instance('salecreate')->initial(2);
            if(!$this->cash ){
                $this->change=0;
            }else{
                $this->change = number_format(round($this->cash - $x,2),2,'.','');
            }
    }

    public function saveSale(){
        $rules=[
/*             'serie_correlative'=>'required',  */   
            'cash'=>'required',
            'patient'=>'required',
        ];
        if(Cart::instance('salecreate')->count()==0){
            $this->emit('error','No hay servicios en la lista');
        } else{
/* 
            if($this->voucher==2){

                $rules['name']='required';    
            } */
            $this->validate($rules);
    
            if($this->change <0){
                $this->emit('error','El monto recibido es menor al total');
            }else{
                
                if($this->status==2){
                    $aux_status=3;
                }else{
                    $aux_status=1;
                }

              $sale=Sale::create([
                    'net'=>Cart::instance('salecreate')->subtotal(),
                    'tax'=>Cart::instance('salecreate')->tax(),
                    'discount'=>$this->aux,
                  'subtotal'=>Cart::instance('salecreate')->initial(),
                 /*    'rounding'=>$round, */
                    'total'=>Cart::instance('salecreate')->total(),
                    'cash'=>$this->cash,
                    'change'=>$this->change,
                    'type'=>$this->type,
                    'status'=>$aux_status,
                    'observation'=>$this->observation,
                    'user_id'=>auth()->user()->id,
                    'patient_id'=>$this->patient->id,          
                ]);
             
                Motion::create([
                    'type'=>'1',
                    'amount'=>Cart::instance('salecreate')->total(2),
                    'description'=>'Venta de servicios',
                    'box_id'=>auth()->user()->boxes()->where('status',1)->first()->id,
                    'sale_id'=>$sale->id,
                ]);
               

                if($sale){
                    $items=Cart::instance('salecreate')->content();

                    foreach($items as $item){
                         Detail::create([
                            'name'=>$item->name,
                            'quantity'=>$item->qty,
                            'price'=>$item->price,
                            'price_u'=>(($item->tax*$item->qty)+$item->subtotal)/$item->qty,
                            'tax_u'=>$item->tax,
                            'net_u'=>((($item->tax*$item->qty)+$item->subtotal)/$item->qty)-$item->tax,

                            
                            'net_t'=>$item->subtotal,
                            'tax_t'=>($item->tax*$item->qty),
                            'price_t'=>($item->tax*$item->qty)+$item->subtotal,

                   
                            'description'=>$item->options->description,                           
                            'sale_id'=>$sale->id,
                            'service_id'=>$item->id,    
                        ]);
                  /*       $service=Service::find($item->id);
                        $service->stock=$service->stock-$item->qty;
                        $service->save(); */
                    }
                Cart::instance('salecreate')->destroy();
                $this->saleId=$sale->id;
                 $this->emit('success','Venta realizada');
                 $this->modalpdf=true;
        
                }else{
                    $this->emit('error','Error al realizar la venta');
                }
 
            }
        }
    } 

    public function closemodal()
    {   
        $this->reset([
            'modal',

            'price',

       
        ]);
        $this->service='';
        $this->resetValidation();
    }

    
}
