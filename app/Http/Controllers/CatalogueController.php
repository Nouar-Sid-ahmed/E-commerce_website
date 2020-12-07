<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage\App;
use Illuminate\Http\Request;
use App\Models\product;

class CatalogueController extends Controller
{
    public function index() 
    {
        $products = product::paginate(12);
        return view('catalogue', compact('products'));
    }
}
