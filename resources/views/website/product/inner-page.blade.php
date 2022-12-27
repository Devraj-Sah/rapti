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
                                                <a href="{{route('category.pages',$category->slug)}}">{{$category->code}}</a>
                                                <ul class="sub-menu">
                                                    @foreach($category->childs as $firstLevelMenu)
                                                        @if(count($firstLevelMenu->childs))
                                                            <li class=" menu-item-has-children ">
                                                                <a href="{{route('category.pages',$firstLevelMenu->slug)}}">{{$firstLevelMenu->code}}</a>
                                                                <ul class="sub-menu">
                                                                    @foreach($firstLevelMenu->childs as $secondLevelMenu)
                                                                        @if(count($secondLevelMenu->childs))
                                                                            <li class=" menu-item-has-children ">
                                                                                <a href="{{route('category.pages',$secondLevelMenu->slug)}}">{{$secondLevelMenu->code}}</a>
                                                                                <ul class="sub-menu">
                                                                                    @foreach($secondLevelMenu->childs as $thirdLevelMenu)
                                                                                        <li>
                                                                                            <a href="{{route('category.pages',$thirdLevelMenu->slug)}}">{{$thirdLevelMenu->code}} </a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </li>
                                                                        @else
                                                                            <li>
                                                                                <a href="{{route('category.pages',$secondLevelMenu->slug)}}">{{$secondLevelMenu->code}} </a>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="{{route('category.pages',$firstLevelMenu->slug)}}">{{$firstLevelMenu->code}} </a>
                                                            </li>
                                                        @endif

                                                    @endforeach
                                                </ul>
                                            </li>

                                        @else
                                            <li>
                                                <a href="{{route('category.pages',$category->slug)}}">{{$category->code}}</a>
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
                            <p>There Are {{$products->count()}} Products.</p>
                        </div>
                    </div>

                    <div class="row  product-margin">
                        @if($products)
                            @foreach($products as $product)
                                <div class="col-lg-3 col-md-6  col-sm-12">
                                    {{--  <div class="box">
                                          <div class="product-list-inner">
                                              <div class="product-listing">
                                                  <!-- Image -->
                                                  <figure>
                                                      @if($product->thumbnail)
                                                          <a href="{{route('pages.details',$product->slug)}}" class="img">
                                                              <img src="{{Image::make('uploads/products/'.$product->thumbnail,'category-product')->toUrl()}}"
                                                                   alt="Product Image">
                                                          </a>
                                                      @endif
                                                  </figure>

                                                  <!-- Content -->
                                                  <div class="product-content">
                                                      <!-- Category & Title -->
                                                      <div class="product-category-title">
                                                          <h5 class="product-title"><a
                                                                      href="{{route('pages.details',$product->slug)}}">{{$product->name}}</a>
                                                          </h5>
                                                      </div>
                                                      <!-- Price & Ratting -->

                                                  </div>
                                              </div>
                                          </div>
                                      </div>--}}
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
                                                <div class=""><a href="{{route('pages.details',$product->slug)}}">View</a></div>
                                                {{-- <div><a href="#">Buy Now</a></div>--}}
                                            </div>
                                        </div>
                                        <div class="sp-details">
                                            <h4>{{$product->code}}</h4>
                                            <div class="product-price">
                                                {{-- <span class="price">
                                                     @if($product->compare_price)
                                                         <del><span><span
                                                                         class="currencySymbol">$</span>{{$product->compare_price}}</span></del>
                                                         <ins><span><span class="currencySymbol">$</span>{{$product->price}}</span></ins>
                                                     @else
                                                         <ins><span><span class="currencySymbol">$</span>{{$product->price}}</span></ins>
                                                     @endif


                                                 </span>--}}
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