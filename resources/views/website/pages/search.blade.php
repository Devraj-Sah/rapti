@extends('website.layouts.app')
@section('content')
    <section class="product-category mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 ">
                    <div class="sidebar-section">
                        <div class="sidebar-category">
                            <h3 class="sidebar-title">Category</h3>
                            <div class="verticalcat-menu">
                                <ul>
                                    @foreach($categories as $category)
                                        @if(count($category->childs))
                                            <li class=" menu-item-has-children ">
                                                <a href="{{route('category.pages',$category->slug)}}">{{$category->name}}</a>
                                                <ul class="sub-menu">
                                                    @foreach($category->childs as $firstLevelMenu)
                                                        @if(count($firstLevelMenu->childs))
                                                            <li class=" menu-item-has-children ">
                                                                <a href="{{route('category.pages',$firstLevelMenu->slug)}}">{{$firstLevelMenu->name}}</a>
                                                                <ul class="sub-menu">
                                                                    @foreach($firstLevelMenu->childs as $secondLevelMenu)
                                                                        @if(count($secondLevelMenu->childs))
                                                                            <li class=" menu-item-has-children ">
                                                                                <a href="{{route('category.pages',$secondLevelMenu->slug)}}">{{$secondLevelMenu->name}}</a>
                                                                                <ul class="sub-menu">
                                                                                    @foreach($secondLevelMenu->childs as $thirdLevelMenu)
                                                                                        <li>
                                                                                            <a href="{{route('category.pages',$thirdLevelMenu->slug)}}">{{$thirdLevelMenu->name}} </a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </li>
                                                                        @else
                                                                            <li>
                                                                                <a href="{{route('category.pages',$secondLevelMenu->slug)}}">{{$secondLevelMenu->name}} </a>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="{{route('category.pages',$firstLevelMenu->slug)}}">{{$firstLevelMenu->name}} </a>
                                                            </li>
                                                        @endif

                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{route('category.pages',$category->slug)}}">{{$category->name}}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">

                    <div class="sort-wrapper">
                        <div class="product-numbers">
                            <p>There Are {{$products->count()}} Products found for <strong>{{$keywords}}</strong></p>
                        </div>
                    </div>
                    <div class="row  product-margin">
                        @if($products)
                            @foreach($products as $product)
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="single-popular-product">
                                        <div class="sp-thumb">
                                            <img src="{{ Image::make(public_path('uploads/products/'.$product->thumbnail),'product-thumb')->toUrl() }}"
                                                 alt=""/>
                                            @if($product->compare_price)
                                                <div class="pro-badge">
                                                    <p class="sale">SALE</p>
                                                </div>
                                            @elseif($product->hot_deal)
                                                <div class="pro-badge">
                                                    <p class="hot">HOT</p>
                                                </div>
                                        @endif
                                        <!-- -->
                                            <div class="product-overlay">
                                                <div class=""><a href="{{route('pages.details',$product->slug)}}">View More</a></div>
                                                {{--<div><a href="#">Buy Now</a></div>--}}
                                            </div>
                                        </div>
                                        <div class="sp-details">
                                            <h4>{{$product->name}}</h4>
                                            <div class="product-price">
                                <span class="price">
                                    @if($product->compare_price)
                                        <del><span><span
                                                        class="currencySymbol">$</span>{{$product->price}}</span></del>
                                        <ins><span><span class="currencySymbol">$</span>{{$product->compare_price}}</span></ins>
                                    @else
                                        <ins><span><span class="currencySymbol">$</span>{{$product->price}}</span></ins>
                                    @endif


                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row">
                        <nav aria-label="Page navigation example">
                            {{$products->links()}}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection