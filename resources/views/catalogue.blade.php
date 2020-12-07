@extends('layouts.app')
@section('title', 'Catalogue')
@section('content')
@if(session('status'))
    <p style="color:white">{{session('status')}}</p>
@endif
@foreach($products->chunk(4) as $chunk)
   <div class="ligne">
       	@foreach($chunk as $product)
                <div class="image">
				<div><a style="text-decoration:none" href="produit/{{ $product->id }}">
						<p class="namimage">{{ $product->name }}</p>
						<img class="img" src="{{ $product->picture }}" all="failled load" width="250" height="250">
				</a></div>
				<div>
					<p><button class="button" onclick="ajoutPanier({{ $product->id }},'{{ $product->name }}',{{ $product->price }},{{ $product->stock }});location.href='{{ route('panier') }}'">Achat direct</button></p>
				</div>
                </div>
				@endforeach
   			</div>
		@endforeach
		{{ $products->links() }}
@endsection
