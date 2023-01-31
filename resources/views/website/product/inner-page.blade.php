@extends('website.layouts.app')
@section('content')

    <section class="product-category mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sort-wrapper">
                        <div class="product-numbers">
                            <p>There Are {{$categories->count()}} Categories.</p>
                        </div>
                    </div>

                    <div class="row  product-margin" style="display: flex; justify-content:center;">
                        @if($categories)
                            @foreach($categories as $product)
                                <div class="col-lg-3 col-md-6  col-sm-12">
                                    <div class="single-popular-product">
                                        <div class="sp-thumb">
                                            <img src="{{ asset('uploads/category/'.$product->thumbnail)}}" alt=""/>
                                            {{-- <img src="{{ Image::make(public_path('uploads/category/'.$product->thumbnail),'product-thumb')->toUrl() }}" alt=""/> --}}
                                            @if($product->compare_price)
                                                <div class="pro-badge">
                                                    <p class="sale">SALE</p>
                                                </div>
                                            @elseif($product->hot_deal)
                                                <div class="pro-badge">
                                                    <p class="hot">HOT</p>
                                                </div>
                                        @endif
                                            <div class="product-overlay">
                                                <div class="">
                                                    <a href="{{route('category.pages',$product->slug)}}">View</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sp-product-details mt-2">
                                            <h4>{{$product->code}}</h4>
                                            <div class="product-price">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection