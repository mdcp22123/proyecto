<?php

namespace App\Http\Livewire\Sale\Component;

use App\Models\Patient;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
class PatientAdd extends Component
{
    public bool $modal=false;
    public $name,$surname,$document,$number;
    public function render()
    {
        return view('livewire.sale.component.patient-add');
    }

    public function searchDocument()
    {
        $rules=[
            'document'=>'required',
            'number'=>'required|min:8|max:8'
        ];
        $messages=[
            'number.required'=>'Porfavor Seleccione una opcion.',
            'document.required'=>'Porfavor Inserte numero de documento.',
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
                $this->name = $rpta->nombres;
                $this->surname = $rpta->apellidoPaterno .' '.$rpta->apellidoMaterno ;
                $this->emit('success','Datos encontrados');
            }
       }else{
           $this->emit('error','No se encontro el documento');
        } 


    }

    public function save()
    {
        $rules=[
      
            'name'=>'required',
            'surname'=>'required',
            'document'=>'required',
            'number'=>'required|min:8|max:8|unique:patients',

         ];
     
       $this->validate($rules);

       $create=Patient::create([
            'name'=>$this->name,
            'surname'=>$this->surname,
            'document'=>$this->document,
            'number'=>$this->number,

        ]);
        $this->emit('patientCreate',$create->id);
        $this->reset([
            'modal',
            'name',
            'surname',
            'document',
            'number',

        ]);
        $this->resetValidation();
        $this->emit('success','Agregado Correctamente');

    }

    public function closemodal()
    {   
        $this->reset([
            'modal',
            'name',
            'surname',
            'document',
            'number',

        ]);
        $this->resetValidation();
    }
}
