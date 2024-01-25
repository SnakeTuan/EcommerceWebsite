@extends('layouts.front')

@section('title')
    E-shop
@endsection

@section('content')
    @include('layouts.inc.slider')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Featured Products</h2>
                <div class="owl-carousel owl-theme featured-carousel">
                    @foreach($featured_product as $prod)
                    <div class="item">
                        <div class="card">
                            <img src="{{ asset('assets/uploads/product/'.$prod->image) }}" alt="Product Image Here">
                            <div class="card-body">
                                <h5>{{ $prod->name }}</h5>
                                <span class="float-start">{{ $prod->selling_price }}</span>
                                <span class="float-end"><s>{{ $prod->original_price }}</s></span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Trending Category</h2>
                <div class="owl-carousel owl-theme featured-carousel">
                    @foreach($treding_category as $item)
                    <div class="item">
                        <a href="{{ url('view-category/'.$item->slug) }}">
                        <div class="card">
                            <img src="{{ asset('assets/uploads/category/'.$item->image) }}" alt="Category Image Here">
                            <div class="card-body">
                                <h5>{{ $item->name }}</h5>
                                <p>
                                    {{ $item->description }}
                                </p>
                            </div>
                        </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $('.featured-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    })
</script>
@endsection