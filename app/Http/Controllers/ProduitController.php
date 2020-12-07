<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\product;

class ProduitController extends Controller
{
    public function show($produit) {
        return view('produit', ['produit' => product::findOrFail($produit)]);
    }
    public function update(request $request)
    {
        $id = $request->id;
        $product=product::where('id', '=', $id)->first();
        echo $product->stock = $request->stock;
        $product->save();
        return redirect()->route('produit', ['produit' => product::findOrFail($product->id)])->with('message','La Quantité a bien été Modifié!');
    }
}
