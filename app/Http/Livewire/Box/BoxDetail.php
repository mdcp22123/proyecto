<?php

namespace App\Http\Livewire\Box;

use App\Models\Box;
use App\Models\Motion;
use Livewire\Component;

class BoxDetail extends Component
{
    public $modal=false;
    public $modal2=false;
    public $modal3=false;
    public $amount;
    public $observation;
    public $amount_spent;
    public $description_spent;
    public function render()
    {
        
        $box=auth()->user()->boxes()->where('status',1)->first();
      /*   $expenses=$box->motions()->where('type',2)->get();
        dd($expenses); */
        return view('livewire.box.box-detail',compact('box'))->layout('layouts.app');
    }

    public function open(){
        $user=auth()->user();
        $rules=[
            'amount'=>'required|numeric|min:0',
        ];
        $this->validate($rules);

       if(auth()->user()->boxes()->where('status',1)->first()){
            $this->emit('error','Ya existe una caja abierta para este usuario');

         }else{
            Box::create([
                'opening'=>now(),
                'initial'=>$this->amount,
                'observation'=>$this->observation,
                'user_id'=>$user->id,
                'status'=>1,
            ]);
            $this->modal=false;
            $this->emit('success','Aperturado Correctamente');
         }
        


    }

    public function close(){

        $box=auth()->user()->boxes()->where('status',1)->first();
        $box->update([
            'closing'=>now(),
            'income'=>number_format($box->motions()->where('type',1)->sum('amount'),2,'.', ''),
            'expenses'=>number_format($box->motions()->where('type',2)->sum('amount'),2,'.', ''),
            'balance'=>number_format((($box->motions()->where('type',1)->sum('amount'))-($box->motions()->where('type',2)->sum('amount'))),2,'.', ''),
            'final'=>number_format($box->initial+(($box->motions()->where('type',1)->sum('amount'))-($box->motions()->where('type',2)->sum('amount'))),2,'.', ''),
            'status'=>2,
        ]);
        $box->save();
        $this->modal2=false;
        $this->emit('success','Cerrado Correctamente');
    }

    public function spent(){
       $rules=[
           'amount_spent'=>'required|numeric|min:1',
           'description_spent'=>'required',
       ];
       $this->validate($rules);
       Motion::create([
            'type'=>2,
            'description'=>$this->description_spent,
           'amount'=>$this->amount_spent,
           'box_id'=>auth()->user()->boxes()->where('status',1)->first()->id,
       ]);
       $this->reset('amount_spent','description_spent');
       $this->resetValidation();
         $this->modal3=false;
            $this->emit('success','Gasto registrado Correctamente');

    }
}
