<?php

namespace App\Http\Livewire\Sale\Component;

use App\Models\Patient;
use Livewire\Component;

class PatientSearch extends Component
{
    public $query ,$event;
    public function render()
    {
        if($this->query != ''){
            $patients=Patient::where('name','like','%' . $this->query .'%')
            ->orWhere('surname','like','%' . $this->query .'%')
            ->orWhere('number','like','%' . $this->query .'%')
            ->take(3)->get();
        }else{
            $patients = [];
        }
        return view('livewire.sale.component.patient-search',compact('patients'));
    }

    public function selectPatient($patientId)
    {
        $this->emitUp($this->event,$patientId);
    }
}
