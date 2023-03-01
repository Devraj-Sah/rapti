@extends('website.layouts.app')
@section('content')

    <section class="product-category mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sort-wrapper">
                        <div class="product-numbers" style="flex: none; width:100%">
                            {{-- <p>There Are   
                                @if (isset($is_product)) 
                                    {{$products->count()}} Products in <span class="badge bg-info p-3" style="font-size: 12px">{{$model->code}}</span>   
                                @else 
                                    {{$products->count()}} Sub-Categories in <span class="badge bg-info p-3" style="font-size: 12px">{{$model->code}}</span> 
                                @endif 
                                    Categories .
                            </p> --}}
                            
                                @if (isset($is_product)) 
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="badge bg-info p-3" style="font-size: 12px">{{$model->code}}</span> 
                                        </div>
                                        <div class="col-6" style="display:flex; flex-direction:row-reverse">
                                            <button onclick="window.history.back();" style="padding: 7px 11px 6px 10px;
                                                                                            background-color: #17a2b8;
                                                                                            border-radius: 4px;
                                                                                            color: #2b2b2b;
                                                                                            border-color: antiquewhite;">
                                                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
                                            </button>
                                        </div>
                                    </div>                                 
                                    
                                @else 
                                    <span class="badge bg-info p-3" style="font-size: 12px">{{$model->code}}</span> 
                                @endif                                   
                           
                           
                        </div>
                    </div>

                    <div class="row  product-margin">
                        @if($products)
                            @foreach($products as $product)
                                <div class="col-lg-3 col-md-6  col-sm-12">
                                    <div class="single-popular-product">
                                        <div class="sp-thumb">
                                            {{-- <img src="{{ asset('uploads/category/'.$product->thumbnail)}}" alt=""/> --}}
                                            @if (isset($is_product))
                                                <img src="{{ Image::make(public_path('uploads/products/'.$product->thumbnail),'product-thumb')->toUrl() }}" alt=""/>
                                                {{-- <img src="{{asset('uploads/products/'.$product->thumbnail)}}" alt=""/> --}}
                                            @else
                                                {{-- <img src="{{ Image::make(public_path('uploads/category/'.$product->thumbnail),'product-thumb')->toUrl() }}" alt=""/> --}}
                                                <img src="{{asset('uploads/category/'.$product->thumbnail)}}" alt=""/>
                                            @endif
                                            @if (isset($is_product))
                                                <div class="pro-badge">
                                                    @if($product->compare_price)
                                                        <p class="sale">SALE</p>
                                                    @elseif($product->hot_deal)
                                                        <p class="hot">HOT</p>
                                                    @endif
                                                        <p class="price">${{$product->price}}</p>
                                                </div>
                                            @endif
                                            <div class="product-overlay">
                                                <div class="">
                                                    @if (isset($is_product))
                                                        <a href="{{route('pages.details',$product->slug)}}">View</a>
                                                    @else
                                                        <a href="{{route('category.pages',$product->slug)}}">View</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @if (isset($is_product))

                                            <div class="sp-product-details mt-2">
                                                <h4>{{$product->code}}</h4>
                                                <div class="product-price">
                                                </div>
                                            </div>

                                        @else
                                            <a href="{{route('category.pages',$product->slug)}}">
                                                <div class="sp-details">
                                                    <h4><span>{{$product->code}}</span></h4>
                                                    <div class="product-price">
                                                    </div>
                                                </div>
                                            </a>

                                        @endif

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