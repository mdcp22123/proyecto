<?php

namespace App\Http\Livewire\Cashout;

use App\Models\Sale;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;

class CashoutIndex extends Component
{
    public $user,$start,$final,$total,$sales,$salescanceled,$tax,$net;
    public $detail,$modal=false;
    public $salemade,$salecanceled;
    public function mount(){
        $this->sales=[];
        $this->salescanceled=[];
    }
    public function render()
    {
        $users=User::all();
 
        return view('livewire.cashout.cashout-index',compact('users'))->layout('layouts.app');
    }

    public function query(){
        $dstart=Carbon::parse($this->start)->format('Y-m-d') . ' 00:00:00';
        $dfinal=Carbon::parse($this->final)->format('Y-m-d') . ' 23:59:59';
        $this->sales=Sale::whereBetween('created_at',[$dstart,$dfinal])->where('user_id',$this->user)->where('status','!=',2)->get();
        $this->salescanceled=Sale::whereBetween('created_at',[$dstart,$dfinal])->where('status',2)->where('user_id',$this->user)->get();

        $this->total=$this->sales ? $this->sales->sum('total')  :0;
        $this->tax=$this->sales ? $this->sales->sum('tax'):0;
        $this->net=$this->sales ? $this->sales->sum('net'):0;

        $this->salemade=$this->sales ? $this->sales->count():0;
        $this->salecanceled=$this->salescanceled ? $this->sales->count():0;

       /*  dd($this->salescanceled); */

    }

    public function detail(Sale $sale){
        $this->detail=$sale;
        $this->modal=true;
    }
}
