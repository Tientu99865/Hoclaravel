<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products;

class ProductController extends Controller
{
    //
    public function index(){

        $products = products::paginate(5);
        return view('view_products',['products'=>$products]);
    }
}
