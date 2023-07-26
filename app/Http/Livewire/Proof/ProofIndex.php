<?php

namespace App\Http\Livewire\Proof;

use App\Models\Proof;
use Livewire\Component;
use Livewire\WithPagination;


class ProofIndex extends Component
{   

    use WithPagination;
    public $search;
    public bool $modal=false;
    public $cant=10;
    public $status;




    protected $listeners=['delete'];


    public function paginationView()
    {
        return 'tailwind-pagination';
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->reset('status');
    }
    public function updatingStatus()
    {
        $this->resetPage();
        $this->reset('search');

    }

    public function render()
    {
   

       /*  $proofs=Proof::where('name','LIKE','%'.$this->search.'%')
            ->orWhere('number','LIKE','%'.$this->search.'%')
            ->orWhere('serie','LIKE','%'.$this->search.'%')
            ->orWhere('correlative','LIKE','%'.$this->search.'%')
            ->when($this->status,function ($query){
                $query->where('status',$this->status);
            }) ->paginate($this->cant); */
            $proofs=Proof::query()
            ->when($this->status,function ($query){
                $query->where('status',$this->status);
            })
            ->when($this->search,function ($query){
                $query->where('name','LIKE','%'.$this->search.'%')
                ->orWhere('number','LIKE','%'.$this->search.'%')
                ->orWhere('serie','LIKE','%'.$this->search.'%')
                ->orWhere('correlative','LIKE','%'.$this->search.'%');
            })
            ->latest('id')
            ->paginate($this->cant); 
        
        return view('livewire.proof.proof-index',compact('proofs') )->layout('layouts.app') ;
    }
}
