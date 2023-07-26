<?php

namespace App\Http\Controllers\Box;

use App\Http\Controllers\Controller;
use App\Models\Box;
use Illuminate\Http\Request;

class BoxShow extends Controller
{
    public function index(Box $box){
        return view('box.box-show',compact('box'));
    }
}
