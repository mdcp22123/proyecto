<?php

use App\Http\Controllers\Box\BoxShow as BoxBoxShow;
use App\Http\Controllers\GeneratePdf;
use App\Http\Controllers\ProofController;
use App\Http\Controllers\ProofGenerate;
use App\Http\Controllers\ProofShow;
use App\Http\Controllers\SaleDetail;
use App\Http\Livewire\Boox\BooxShow;
use App\Http\Livewire\Box\BoxDetail;
use App\Http\Livewire\Patient\PatientIndex;
use App\Http\Livewire\Proof\ProofIndex;
use App\Http\Livewire\Sale\SaleCreate;
use App\Http\Livewire\Sale\SaleIndex;
use App\Http\Livewire\Service\ServiceIndex;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Box\BoxIndex;
use App\Http\Livewire\Box\BoxShow;
use App\Http\Livewire\Cashout\CashoutIndex;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/service',ServiceIndex::class)->name('service');

    Route::get('/patient',PatientIndex::class)->name('patient');

    Route::get('/sale',SaleIndex::class)->name('sale');
    Route::get('/sale/create',SaleCreate::class)->name('create'); 
    Route::get('/sale/{sale}/edit',[SaleDetail::class,'index'])->name('sale.edit');

    Route::get('/sale/{sale}/pdf-a4',[GeneratePdf::class,'pdfA4'])->name('generate.pdf-a4');

    Route::get('/sale/{sale}/ticket-sale',[GeneratePdf::class,'ticketSale'])->name('generate.ticket.sale');
    Route::get('/sale/{proof}/boleta-ticket',[GeneratePdf::class,'boletaTicket'])->name('generate.boleta.ticket');
    Route::get('/sale/{proof}/boleta-a4',[GeneratePdf::class,'boletaA4'])->name('generate.boleta.a4');
   

    Route::get('/sale/{proof}/boleta-a4-down', [GeneratePdf::class, 'donwloadBoletaA4'])->name('generate.boleta.a4.down');
    
    Route::get('/proof',ProofIndex::class)->name('proof');
    Route::get('/proof/{sale}/generate',[ProofController::class,'generate'])->name('proof.generate');
    Route::get('/proof/{proof}/show',[ProofController::class,'show'])->name('proof.show');
    Route::get('/proof/{proof}/dowloadxml',[ProofController::class,'dowloadXml'])->name('proof.dowloadxml');
    Route::get('/proof/{proof}/dowloadcdr',[ProofController::class,'dowloadCdr'])->name('proof.dowloadcdr');

    Route::get('/box/{box}/ticket',[GeneratePdf::class,'box'])->name('generate.ticket.box');
    Route::get('/box/{box}/ticket-ult',[GeneratePdf::class,'boxUlt'])->name('generate.ticket.box-ult');

    Route::get('/box',BoxIndex::class)->name('box');
    Route::get('/box/detail',BoxDetail::class)->name('box.detail');
    Route::get('/box/{box}/show',[BoxBoxShow::class,'index'])->name('box.show');

    Route::get('/cashout',CashoutIndex::class)->name('cashout');

   /*  Route::get('/prueba',function(){
        $box=$box=auth()->user()->boxes()->where('status',1)->exists();

    })->name('prueba'); */
    /*
    Route::get('/ambient',AmbientIndex::class)->name('ambient');
    Route::get('/attention',AttentionIndex::class)->name('attention');
    Route::get('/specialty',SpecialtyIndex::class)->name('specialty');
    Route::get('/user',UserIndex::class)->name('user');
    Route::get('/sale',SaleIndex::class)->name('sale');

    Route::get('/sale/create',SaleCreate::class)->name('sale.create');

    Route::get('/sale/{sale}/pdf-a4',[GeneratePdf::class,'pdfA4'])->name('generate.pdf-a4');
    Route::get('/sale/{sale}/pdf-ticket',[GeneratePdf::class,'pdfTicket'])->name('generate.pdf-ticket');

    Route::get('/prueba',Prueba::class); */
});
