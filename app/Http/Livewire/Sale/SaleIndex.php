<?php

namespace App\Http\Livewire\Sale;

use App\Models\Sale;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class SaleIndex extends Component
{
    use WithPagination;
    public $search;
    public bool $modal=false;
    public $cant=10;
    public $componentName;

   /*  public $sale; */
    public $detail;


  

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
        Cart::destroy();
        $this->componentName='Ventas';
            
    }

    public function render()
    {
        $sales=Sale::where('id', 'like', '%'  . $this->search .'%')
            ->orWhereHas('patient', function (Builder $query) {
            $query->where('name', 'like', '%'  . $this->search .'%' );
           })
           ->orWhereHas('patient', function (Builder $query) {
            $query->where('surname', 'like', '%'  . $this->search .'%' );
           }) ->orWhereHas('patient', function (Builder $query) {
            $query->where('number', 'like', '%'  . $this->search .'%' );
           })
        ->latest('id')
        ->paginate($this->cant);

        return view('livewire.sale.sale-index',compact('sales') )->layout('layouts.app'); ;
    }

    public function details(Sale $sale)
    {

        $this->detail=$sale;
        $this->modal=true;
    }

    public function delete(Sale $sale)
    {
        $sale->delete();
        $this->emit('alert','El paciente se ha eliminado correctamente');
    }
}
