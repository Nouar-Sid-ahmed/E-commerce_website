<?php

namespace App\Http\Controllers;
use App\Models\basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PanierController extends Controller
{
    public function index(){
        return view('panier');
    }
}
