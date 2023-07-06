@extends('layouts.app')

@section('page-title', 'Buy products online with great discount')

@section('content')
    {{-- carousel --}}
    <div id="mainBanner" class="carousel slide main-banner" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#mainBanner" data-slide-to="0" class="active"></li>
            <li data-target="#mainBanner" data-slide-to="1"></li>
            <li data-target="#mainBanner" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">

            @foreach($carousels as $index => $carousel)
                <div class="carousel-item {{$index == 1 ? 'active' : ''}}">
                    <img class="d-block w-100" src="{{asset($carousel->img)}}" alt="First slide">
                </div>
            @endforeach

        </div>
        <a class="carousel-control-prev" href="#mainBanner" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#mainBanner" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    {{-- categories-section --}}
    <section class="categories-section container my-4 h-100">
        <h3>Categories</h3>
        <div class="row h-100">

            <div class="col-4 col-sm-4 col-md-2 p-2">
                <a href="{{ 'catalog?filter[subCategory]=Mobile' }}">
                    <div class="card shadow-hover">
                        <div class="card-body">
                            <img src="{{asset('images/demo/electronics.jpg')}}" class="img-fluid" alt="">
                            <p class="card-title text-center">Electronics</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-4 col-sm-4 col-md-2 p-2">
                <a href="{{ 'catalog?filter[subCategory]=Furniture' }}">
                    <div class="card shadow-hover">
                        <div class="card-body">
                            <img src="{{asset('images/demo/home.jpg')}}" class="img-fluid" alt="">
                            <p class="card-title text-center">Home Lifestyle</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-4 col-sm-4 col-md-2 p-2">
                <a href="{{ 'catalog?filter[subCategory]=Diapers' }}">
                    <div class="card shadow-hover">
                        <div class="card-body">
                            <img src="{{ asset('images/demo/baby.jpg') }}" class="img-fluid" alt="">
                            <p class="card-title text-center">Baby</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-4 col-sm-4 col-md-2 p-2">
                <a href="{{ 'catalog?filter[subCategory]=Mens' }}">
                    <div class="card shadow-hover">
                        <div class="card-body">
                            <img src="{{ asset('images/demo/sport.jpg') }}" class="img-fluid" alt="">
                            <p class="card-title text-center">Sport & outdoor</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-4 col-sm-4 col-md-2 p-2">
                <a href="{{ 'catalog?filter[subCategory]=Kitchen' }}">
                    <div class="card shadow-hover">
                        <div class="card-body">
                            <img src="{{ asset('images/demo/kitchen.jpg') }}" class="img-fluid" alt="">
                            <p class="card-title text-center">Kitchen</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-4 col-sm-4 col-md-2 p-2">
                <a href="{{ 'catalog?filter[subCategory]=Pet' }}">
                    <div class="card shadow-hover">
                        <div class="card-body">
                            <img src="{{ asset('images/demo/pet.jpg') }}" class="img-fluid" alt="">
                            <p class="card-title text-center">Pets</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </section>

    {{-- just for you --}}
    <section class="just-for-you-section container h-100 my-4">
        <h3>Just For You</h3>
        <div class="row h-100">
            @foreach($newProducts as $product)
                <div class="col-6 col-sm-4 col-md-2 p-2">
                    <a href="{{ $product->path() }}">
                        <div class="card shadow-hover h-100">
                            <img src="{{ asset($product->productImage->first()->original) }}" class="card-img-top"
                                 alt="">
                            <div class="card-body ">
                                <p class="product-title">{{ substr($product->title,0,35) }}..</p>
                                @if($product->onSale)
                                    <small class="line-through text-dark">Rs. {{ $product->price }}</small>
                                    <p class="product-price">Rs.{{ number_format($product->sale_price) }}</p>
                                @else
                                    <p class="product-price">Rs.{{ number_format($product->price) }}</p>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </section>

@endsection
