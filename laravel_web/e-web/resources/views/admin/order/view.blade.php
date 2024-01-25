@extends('layouts.front')

@section('title')
    E-shop
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Order View
                        <a href="{{ url('orders') }}" class="btn btn-warning float-end text-white">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 order-details">
                            <h4>Shipping Detail</h4>
                            <hr>
                            <label for="">First Name</label>
                            <div class="border">{{ $order->fname }}</div>
                            <label for="">Last Name</label>
                            <div class="border">{{ $order->lname }}</div>
                            <label for="">Email</label>
                            <div class="border">{{ $order->email }}</div>
                            <label for="">Phone Number</label>
                            <div class="border">{{ $order->phone }}</div>
                            <label for="">Shipping Address</label>
                            <div class="border">
                                {{ $order->address }},<br> 
                                {{ $order->country }}, <br>
                                {{ $order->city }}, 
                            </div>
                            <label for="">Zip Code</label>
                            <div class="border">{{ $order->pincode }}</div>
                        </div>
                        <div class="col-md-6">
                            <h4>Shipping Detail</h4>
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->order_item as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>
                                                <img src="{{ asset('assets/uploads/product/'.$item->product->image) }}" width="50px" alt="Product Image Here">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4 class="px-2">Grand Total: <span class="float-end">{{ $order->total_price }}</span></h4>
                            <div class="mt-5 px-2">
                                <label for="">Order Status</label>    
                                <form action="{{ url('update-order/'.$order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select class="form-select" name="order_status">
                                        <option value="0" {{ $order->status == '0' ? 'selected' : '' }} >Pending</option>
                                        <option value="1" {{ $order->status == '1' ? 'selected' : '' }} >Completed</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary float-end mt-3">Update</button>
                                </form>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection