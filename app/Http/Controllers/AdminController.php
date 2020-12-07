<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\product;

class AdminController extends Controller
{
    protected $product;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(product $product)
    {
        $this->middleware('admin');
        $this->product = $product;
    }

    public function index()
    {
        return view('admin');
    }
    
    protected function validator(array $product)
    {
        return Validator::make($product, [
            'name' => ['required', 'string', 'unique:name','max:100'],
            'stock' => ['required', 'integer', 'stock'],
            'price' => ['required', 'integer', 'price'],
            'description' => ['required', 'string', 'description'],
            'picture' => ['required', 'image', 'picture', 'unique:product'],
            'category' => ['required', 'string', 'max:60'],
        ]);
    }

    protected function store(request $request)
    {
        $validatedData = $request->validate([
            'picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    
           ]);
        $product = new product;
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->picture = $request->file('picture')->store('public');
        $product->category = $request->category;
        $product->save();
        return redirect()->route('admin')->with('message','Le Produit a bien été  enregistré!');
    }
    
}
