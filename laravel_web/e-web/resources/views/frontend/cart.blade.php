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
            <a href="{{ url('cart') }}">
                Cart
            </a>
        </h6>
    </div>
</div>
<div class="container">
    <div class="card shadow">
        @if($cart_item->count()>0)
        <div class="card-body">
            @php $total = 0; @endphp
            @foreach($cart_item as $item)
            <div class="row product_data">
                <div class="col-md-2 my-auto">
                    <img src="{{ asset('assets/uploads/product/'.$item->product->image) }}" height="70px" width="70px" alt="Image Here">
                </div>
                <div class="col-md-3 my-auto">
                    <h5>{{ $item->product->name }}</h5>
                </div>
                <div class="col-md-2 my-auto">
                    <h6>{{ $item->product->selling_price }}</h6>
                </div>
                <div class="col-md-3 my-auto">
                    <input type="hidden" class="product_id" value="{{ $item->product->id }}">
                    @if($item->product->quantity > $item->product_quantity)
                    <label for="Quantity">Quantity</label>
                    <div class="input-group text-center mb-3" style="width: 130px;">
                        <button class="input-group-text decrement-btn change-quantity">-</button>
                        <input type="text" name="quantity" value="{{ $item->product_quantity }}" class="form-control quantity-input text-center">
                        <button class="input-group-text increment-btn change-quantity">+</button>
                    </div>
                    @php $total += $item->product->selling_price*$item->product_quantity; @endphp 
                    @else
                    <h6>Out of stock</h6>
                    @endif
                </div>
                <div class="col-md-2 my-auto">
                    <button class="btn btn-danger delete-cart-item-btn"> <i class="fa fa-trash"></i> Remove</button>
                </div>
            </div>     
               
            @endforeach
        </div>
        <div class="card-footer">
            <h6>Total Price: {{ $total }}
            <a href="{{ url('checkout') }}" class="btn btn-outline-success float-end">Proceed to Checkout</a>
            </h6>
        </div>
        @else
        <div class="card-body text-center">
            <h2>Your <i class="fa fa-shopping-cart"></i> cart is empty</h2>
            <a href="{{ url('category') }}">Continue Shopping</a>
        </div>
        @endif
    </div>
</div>

@endsection