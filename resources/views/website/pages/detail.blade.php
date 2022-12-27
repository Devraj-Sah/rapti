@extends('website.layouts.app')
@section('page_title', $product->meta_title)
@section('page_keyword', $product->meta_keywords)
@section('page_description', $product->meta_description)

@section('content')
    @include('website.productDetail-breadcrumb')
    <style>
        a.download {
            border: 1px solid #549969;
            font-size: 13px !important;
            padding: 1px 10px;
            border-radius: 3px;
            color: #549969;
            -webkit-transition: all ease 0.3s;
            transition: all ease 0.3s;
        }

        a.download:hover {
            background: #549969;
            color: #FFF;
            -webkit-transition: all ease 0.3s;
            transition: all ease 0.3s;
        }

        .tabs-description label {
            font-size: 16px;
        }

        .tabs-description h3 {
            font-size: 18px;
        }

        .table th, .table td {
            font-size: 15px;
        }
    </style>
    @if($message = Session::get('success'))
        <div id="update-alert">
            <div class="alert-item-added">
                <div class="icon"><i class="icofont-tick-boxed"></i></div>
                <div class="content">
                    <h4>ITEM ADDED TO YOUR CART</h4>
                    <a href="{{route('cart.index')}}">   <button  >View Cart</button></a>
                </div>
            </div>
        </div>
    @endif

    <div class="product-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-right" >
                    <form>
                        <input type="button" value="Back" onclick="history.back()" style="    padding: 5px 10px;">
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="photos">
                        <ul id="album" class="thumbnail photo-list">
                            @if($product->images)
                                @foreach($product->images as $featuredImage)
                                    <li><a href="#"
                                           data-image="{{asset('uploads/products/featured_image/'.$featuredImage->image)}}"
                                           data-zoom-image="{{asset('uploads/products/featured_image/'.$featuredImage->image)}}">
                                            <img src="{{asset('uploads/products/featured_image/'.$featuredImage->image)}}"
                                                 alt="">
                                        </a></li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="mainimage">
                            <figure>
                                <img src="{{asset('uploads/products/'.$product->thumbnail)}}" id="zoom"
                                     data-zoom-image="{{asset('uploads/products/'.$product->thumbnail)}}" height="auto"
                                     width="100%" alt=""
                                     style="position: relative">
                            </figure>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="productDetails">
                        {!! Form::open(['route' =>'cart.add','method'=>'POST','id'=>'FormCart']) !!}
                        {!! Form::hidden('pid',$product->id) !!}

                        <div class="titleName">Product Code: {{ $product->code }}
                        </div>
                        <div class="cost">
                            <div class="newcost">Price: <span>${{ $product->price }} </span>
                            </div>
                            {{-- <div class="oldcost">Rs:<span>6,166.25 NRP</span>
                             </div>--}}

                        </div>
                        <div class="description">
                            <h3>Short Description</h3>
                            <p>{!! $product->short_desc !!}</p>
                        </div>


                        <div class="quantity">
                            <div class="label">Quantity:</div>
                            <div class="field">
                                <div class="number">
                                    <button type="button" id="sub1" class="sub_qty left"><i
                                                class="fa fa-minus minus"></i></button>
                                    {!! Form::text('qty',1,['class'=>'qty center']) !!}
                                    <button type="button" id="add1" class="add_qty right"><i class="fa fa-plus add"></i>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div class="btn-cart clearfix">
                            <button type="submit" class="addcart">Add to Cart</button>
                           {{-- <button type="submit" class="buy">Buy Now</button>--}}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="row tabs-description mt-5">
                <div class="col-lg-12">
                    <input id="tab1" type="radio" name="tabs" checked>
                    <label for="tab1">Description</label>


                    {{--<input id="tab2" type="radio" name="tabs">
                    <label for="tab2">Catalogue</label>--}}


                    <section id="content1">
                        {!! $product->description !!}
                    </section>
                  {{--  <section id="content2">
                        {!! $product->description !!}
                    </section>--}}
                </div>
            </div>

        </div>
    </div>


    <section class="hitStore_main_new_arrivals">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-title">Similar Products</h2>
                </div>
            </div>
            @php
                $recentProducts = $productHelper->getProducts(Session::get('recentlyViewedProductIds'));
            @endphp
            <div class="row">
                @if($recentProducts)


                    @foreach($recentProducts->take(4) as $similarProduct)
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="single-popular-product">
                                <div class="sp-thumb">
                                    <img src="{{ Image::make(public_path('uploads/products/'.$similarProduct->thumbnail),'product-thumb')->toUrl() }}"
                                         alt=""/>
                                    @if($similarProduct->compare_price)
                                        <div class="pro-badge">
                                            <p class="sale">SALE</p>
                                        </div>
                                    @elseif($similarProduct->hot_deal)
                                        <div class="pro-badge">
                                            <p class="hot">HOT</p>
                                        </div>
                                @endif
                                <!-- -->
                                    <div class="product-overlay">
                                        <div class=""><a href="{{route('pages.details',$similarProduct->slug)}}">View
                                                </a></div>
                                        {{--<div><a href="#">Buy Now</a></div>--}}
                                    </div>
                                </div>
                                <div class="sp-details">
                                    <h4>{{$similarProduct->code}}</h4>
                                   {{-- <div class="product-price">
                                        <span class="price">
                                            @if($similarProduct->compare_price)
                                                <del><span><span
                                                                class="currencySymbol">$</span>{{$similarProduct->price}}</span></del>
                                                <ins><span><span
                                                                class="currencySymbol">$</span>{{$similarProduct->compare_price}}</span></ins>
                                            @else
                                                <ins><span><span
                                                                class="currencySymbol">$</span>{{$similarProduct->price}}</span></ins>
                                            @endif


                                        </span>
                                    </div>--}}

                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif
            </div>
        </div>
    </section>

@endsection
