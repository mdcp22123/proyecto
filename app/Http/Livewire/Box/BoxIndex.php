<?php

namespace App\Http\Livewire\Box;

use App\Models\Box;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
class BoxIndex extends Component
{
    use WithPagination;
    public $search;
    public bool $modal=false;
    public $componentName;
    public $selected_id;
    public $cant=10;

    public $user;
    public $mount;
    public $observation;
    public $aux;
    
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
        $this->componentName='ADMINISTRAR CAJAS';
            
    }
    public function render()
    {
        $users=User::all();
        $boxes=Box::where('id', 'like', '%'  . $this->search .'%')
            ->orWhereHas('user', function (Builder $query) {
            $query->where('name', 'like', '%'  . $this->search .'%' );
           })
        ->latest('id')
        ->paginate($this->cant);
        return view('livewire.box.box-index',compact('boxes','users'))->layout('layouts.app');
    }

    public function save()
    {
        $rules=[
      
            'user'=>'required',
            'mount'=>'required|numeric',
         ];
     
       $this->validate($rules);

       if(auth()->user()->boxes()->where('status',1)->first()){
            $this->emit('error','Ya existe una caja abierta para este usuario');

         }else{
            Box::create([
                'opening'=>now(),
                'initial'=>$this->mount,
                'observation'=>$this->observation,
                'user_id'=>$this->user,
                'status'=>1,
            ]);
            $this->closemodal();
            $this->emit('success','Creado Correctamente');
         }

    }

    public function edit(Box $box)
    {
       $record=$box;
         $this->aux=$record->user_id;

       $this->selected_id=$record->id;
        $this->user=$record->user_id;
       $this->mount=$record->initial;
       $this->observation=$record->observation;
        $this->modal=true;
    }

    public function update()
    {
        $rules=[
      
            'user'=>'required',
            'mount'=>'required|numeric',
         ];
  $box=Box::findOrFail($this->selected_id);

   if($this->aux==$this->user){
        $this->validate($rules);

        
        $box->update([
            'initial'=>$this->mount,
            'observation'=>$this->observation,
       ]);
       $box->save();
       $this->closemodal();
       $this->emit('success','Cambios guardados Correctamente');
    }else{
        if(auth()->user()->boxes()->where('status',1)->first()){
            $this->emit('error','Ya existe una caja abierta para este usuario');
         }else{
             $this->validate($rules);
            $box->update([
                 'initial'=>$this->mount,
                 'observation'=>$this->observation,
                 'user_id'=>$this->user,
            ]);
             $box->save();
             $this->closemodal();
             $this->emit('success','Cambios guardados Correctamente');
         }
    }

    }

    public function delete(Box $box)
    {
      $box->delete();
    }

    public function close(Box $box)
    {
        $box->update([
            'status'=>2,
            'closing'=>now(),
        ]);
        $box->save();
        $this->emit('success','Caja Cerrada Correctamente');
    }

    public function closemodal()
    {   
        $this->reset([
            'modal',
            'mount',
            'observation',
            'user',
            'selected_id'
        ]);
        $this->resetValidation();
    }
}
