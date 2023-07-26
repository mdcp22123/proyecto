<?php

namespace App\Http\Livewire\Sale\Component;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
class CustomerSearch extends Component
{
    public bool $modal=false;
    public $number,$name;
    public function render()
    {
        return view('livewire.sale.component.customer-search');
    }

    public function searchDocument()
    {
        $rules=[
            'number'=>'required|min:8|max:8'
        ];
        $messages=[
            'number.required'=>'Porfavor ingrese un numero de DNI',
            'number.min'=>'El numero de RUC debe tener 8 digitos.',
            'number.max'=>'El numero de DNI debe tener 8 digitos.',
    
        ];
        $this->validate($rules,$messages);

        $token=config('services.apiperu.token');
        $urldni=config('services.apiperu.urldni');

        $response= Http::withHeaders([
            'Referer' => 'https://apis.net.pe/consulta-dni-api',
            'Authorization' => 'Bearer ' . $token
        ])->get($urldni.$this->number);
           
       $rpta=json_decode($response);

       if($rpta){
            if( isset( $rpta->error ) ){
                $this->emit('error',$rpta->error);
            }else{
                $this->name=$rpta->nombre;
              
                $this->emit('success','Datos encontrados');
            }
       }else{
           $this->emit('error','No se encontro el documento');
        } 


    }

    public function nice(){
        $rules=[
            'number'=>'required|min:8|max:8',
            'name'=>'required',
            
        ];
        $this->validate($rules);
        $this->emit('customerSearch',$this->name,$this->number);
        $this->reset([
            'name',
            'number',
            'modal'
        ]);
        $this->resetValidation();
        $this->emit('success','Agregado Correctamente');

    }

    public function closemodal()
    {   
        $this->reset([
            'modal',
            'number',
            'name',
            
        ]);
        $this->resetValidation();
    }
}
