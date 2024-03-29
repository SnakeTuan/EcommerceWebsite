@extends('layouts.front')

@section('title')
    E-shop
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('/') }}">
                Home
            </a> / 
            <a href="{{ url('/view-category/'.$product->category->slug) }}">
                {{ $product->category->name }}
            </a> / 
            <a href="#">
                {{ $product->name }}
            </a>
        </h6>
    </div>
</div>
<div class="container">
    <div class="class shadow product_data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 border-right">
                    <img src="{{ asset('assets/uploads/product/'.$product->image) }}" class="w-100" alt="">
                </div>
                <div class="col-md-8">
                    <h2 class="mb-0">
                        {{ $product->name }}
                        @if($product->trending == '1')
                        <label style="font-size: 16px;" class="float-end badge bg-danger trending_tag">Trending</label>
                        @endif
                    </h2>
                    <hr>
                    <label class="me-3">Original Price: <s>Rs {{ $product->original_price }}</s></label>
                    <label class="fw-bold">Selling Price: Rs {{ $product->selling_price }}</label>
                    <p class="mt-3">
                        {!! $product->small_description !!}
                    </p>
                    </hr>
                    @if($product->quantity > 0)
                        <label class="badge bg-success">In stock</label>
                    @else
                        <label class="badge bg-danger">Out of stock</label>
                    @endif
                    <div class="row mt-2">
                        <div class="col-md-2">
                            <input type="hidden" value="{{ $product->id }}" class="product_id">
                            <label for="Quantity">Quantity</label>
                            <div class="input-group text-center mb-3">
                                <button class="input-group-text decrement-btn">-</button>
                                <input type="text" name="quantity" value="1" class="form-control quantity-input text-center">
                                <button class="input-group-text increment-btn">+</button>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <br/>
                            @if($product->quantity > 0)
                                <button type="button" class="btn btn-primary me-3 add-to-cart-btn float-start">Add to cart <i class="fa fa-shopping-cart"></i> </button>
                            @endif
                            <button type="button" class="btn btn-success me-3 float-start">Add to wishlist <i class="fa fa-heart"></i> </button>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <hr>
                <h3>Description</h3>
                <p class="mt-3">
                    {!! $product->description !!}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
