<?php

namespace App\Http\Livewire\Sale;

use App\Models\Motion;
use App\Models\Sale;
use App\Models\Service;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SaleEdit extends Component
{
    use AuthorizesRequests;
    public $sale;
     public $aux; 
    public $cash;
    public $change;
    public $status;
     public $discount;
     public $observation;

     protected $listeners=['saveEdit'];

      public function mount(Sale $sale)
    {
            $x=$sale->total+$sale->discount;
    
             $y=$sale->discount;
            $this->aux=$sale->discount;
            $p=($y*100)/$x;
            Cart::instance('saleedit')->setGlobalDiscount($p); 
         
        $this->sale = $sale; 
        $this->cash = $sale->cash;
        $this->change = $sale->change;
        $this->discount = $sale->discount;
        $this->aux = $sale->discount;
        $this->observation = $sale->observation;
        $this->status = $sale->status;

         foreach($sale->details as $item){
            Cart::instance('saleedit')->add(['id' => $item->service_id,
            'name' =>  $item->name,
            'qty' => $item->quantity,
            'price' =>  $item->price,
            'weight' => 550,
            'options' => [
                'description' => $item->name,
                ]
            ]);
        }
    }

    public function render()
    {$this->authorize('box-asing');
   
        return view('livewire.sale.sale-edit');
    }


    public function discount($resp)
    {   $this->validate(
        [
            'discount'=>'required|numeric',
        ]
        );
        if($resp==1){

            $d=Cart::instance('saleedit')->initial(2)*10;
            $c=floor($d)/10;
            $t=Cart::instance('saleedit')->initial(2)-$c;
            $x=Cart::instance('saleedit')->initial(2)-$t;   
            $y=$this->discount;
            $p=($y*100)/$x;

            if($p>100 || $p<0){
                $this->emit('error','El descuento no puede ser mayor al 100% o menor a 0');
                $this->discount='';
            }else{
                Cart::instance('saleedit')->setGlobalDiscount($p);
                $this->aux=$this->discount;
                $this->change='';
                $this->cash='';
                $this->emit('success','Descuento aplicado');
            }
        }
        if($resp==0){
            $this->discount='';
            $this->aux=0;
            Cart::instance('saleedit')->setGlobalDiscount(0);
            $this->change='';
            $this->cash='';
            $this->emit('success','Descuento Quitado'); 
        }         
    }

    public function updatedCash()
    {          
            $d=Cart::instance('saleedit')->total(2)*10;
            $c=floor($d)/10;
            $t=Cart::instance('saleedit')->total(2)-$c;
            $x=Cart::instance('saleedit')->total(2)-$t;
            if(!$this->cash ){
                $this->change=0;
            }else{
                $this->change = number_format(round($this->cash - $x,2),2,'.','');
            }
    }

    public function saveEdit(){
  
        $rules=[
  
            'cash'=>'required',
            'observation'=>'required',

        ];
        $messages=[
            'cash.required'=>'El campo efectivo es obligatorio',
            'observation.required'=>'El campo observación es obligatorio',
        ];

       
        if(  Cart::instance('saleedit')->count()==0){
            $this->emit('error','Porfavor Ingrese al menos un servicio');
        }else{
            $this->validate($rules,$messages);

            if($this->cash < Cart::instance('saleedit')->total(2)){
                $this->emit('error','El monto recibido es menor al total');
            }else{

             
                $d=Cart::instance('saleedit')->total()*10;
                  $c=floor($d)/10;
                  $t=Cart::instance('saleedit')->total()-$c; 
                  $round=number_format(round($t,2),2);

                /*   $y=Cart::instance('saleedit')->total()*10;
                  $z=floor($y)/10;
                  $w=Cart::instance('saleedit')->total()-$z; */
                  $x=Cart::instance('saleedit')->total();
                  $total=$x;
                $this->sale->update([
                    'net'=>Cart::instance('saleedit')->subtotal(),
                    'tax'=>Cart::instance('saleedit')->tax(),
                    'discount'=>$this->aux,
                    'subtotal'=>Cart::instance('saleedit')->total(),
                    'rounding'=>$round,
                    'total'=>$total,
                    'cash'=>$this->cash,
                    'change'=>$this->change,
                    'observation'=>'EDITADO: '.$this->observation,
             ]);

             $box=auth()->user()->boxes()->where('status',1)->first();
             $motion=$box->motions()->where('sale_id',$this->sale->id)->first();
             $motion->update([
                'amount'=>$total,
             ]);


             
             
/*                 $this->sale->details()->delete(); */
                $items=Cart::instance('saleedit')->content();
                foreach($items as $item){
                    $this->sale->details()->update([
                     
                       'price'=>$item->price,
                       'price_u'=>(($item->tax*$item->qty)+$item->subtotal)/$item->qty,
                       'tax_u'=>$item->tax,
                       'net_u'=>((($item->tax*$item->qty)+$item->subtotal)/$item->qty)-$item->tax,

                       
                       'net_t'=>$item->subtotal,
                       'tax_t'=>($item->tax*$item->qty),
                       'price_t'=>($item->tax*$item->qty)+$item->subtotal,
                  

                   ]);

                   
                   session()->flash('message', 'EDITADO CORRECTAMENTE');
                   return redirect()->to(route('sale.edit',$this->sale->id));
             /*       $this->redirect(); */
           /*         $this->with('edit'); */
               }

             /*    foreach(Cart::instance('saleedit')->content() as $item){
                    $this->sale->details()->create([
                        'service_id'=>$item->id,
                        'name'=>$item->name,
                        'quantity'=>$item->qty,
                        'price'=>$item->price,
                    ]);
                } */

            }
        }
        /* else{
        } */



        /* $this->sale->cash=$this->cash;
        $this->sale->change=$this->change;
        $this->sale->discount=$this->discount;
        $this->sale->observation=$this->observation;
        $this->sale->save();
        $this->sale->details()->delete();
        foreach(Cart::instance('saleedit')->content() as $item){
            $this->sale->details()->create([
                'service_id'=>$item->id,
                'name'=>$item->name,
                'quantity'=>$item->qty,
                'price'=>$item->price,
            ]);
        }
        $this->emit('success','Venta editada correctamente');
        $this->emit('saleEdit');
        $this->modal=false;
        Cart::instance('saleedit')->destroy(); */
    }

    public function saveStatus(){
        $this->validate([
            'status'=>'required',
        ]);
        $this->sale->status='2';
        $this->sale->save();

        $box=auth()->user()->boxes()->where('status',1)->first();
             $motion=$box->motions()->where('sale_id',$this->sale->id)->first();
             $motion->update([
                'description'=>'Venta de servicio ANULADO',
                'amount'=>'0',
             ]);
        $this->emit('success','ANULADO CORRECTAMENTE');
      
    }
}
