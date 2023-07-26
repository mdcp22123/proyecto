<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class SaleDetail extends Controller
{
    function index(Sale $sale){
      $this->authorize('saleEdit',$sale);
      Cart::instance('saleedit')->destroy();
        return view('sale.sale-edit',compact('sale'));
      /*   return view('sale.sale-detail'); */
    }
}
