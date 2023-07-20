<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class manageproductcontroller extends Controller
{
    public function showform(){
        return view('manageproducts.productsform');
    }
}
