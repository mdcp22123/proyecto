<?php

namespace App\Http\Livewire\Patient;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
class PatientIndex extends Component
{
    use WithPagination;
    public $search;
    public bool $modal=false;
    public $cant=10;
    public $componentName;
    public $selected_id;

    public $name,$surname,$document,$number;

    protected $listeners=['delete'];


    public function paginationView()
    {
        return 'tailwind-pagination';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    

    public function mount()
    {
        $this->componentName='Pacientes';
            
    }
    public function render()
    {
        $patients=Patient::where('number','like','%' . $this->search .'%')
        ->orWhere('name','like','%' . $this->search .'%')
        ->orWhere('surname','like','%' . $this->search .'%')
        ->latest('id')->paginate($this->cant);
        return view('livewire.patient.patient-index',compact('patients'))->layout('layouts.app');
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

        Patient::create([
            'name'=>$this->name,
            'surname'=>$this->surname,
            'document'=>$this->document,
            'number'=>$this->number,
        ]);
        $this->closemodal();
        $this->emit('success','Agregado Correctamente');

    }

    public function edit(Patient $patient)
    {
       $record=$patient;

       $this->selected_id=$record->id;
        $this->name=$record->name;
       $this->surname=$record->surname;
       $this->document=$record->document;
       $this->number=$record->number;
        $this->modal=true;
    }

    public function update()
    {
        $rules=[
      
            'name'=>'required',
            'surname'=>'required',
            'document'=>'required',
            'number'=>"required|min:8|max:8|unique:patients,number,{$this->selected_id}",
         ];
     
       $this->validate($rules);

       $patient=Patient::findOrFail($this->selected_id);
        
       $patient->update([
        'name'=>$this->name,
        'surname'=>$this->surname,
        'document'=>$this->document,
        'number'=>$this->number,
       ]);
        $patient->save();
        $this->closemodal();
        $this->emit('success','Cambios guardados Correctamente');

    }

    public function delete(Patient $patient)
    {
      $patient->delete();
    }

    public function closemodal()
    {   
        $this->reset([
            'modal',
            'name',
            'surname',
            'document',
            'number',
            'selected_id'
        ]);
        $this->resetValidation();
    }
}
