@extends('website.layouts.app')
@section('content')


    @include('website.partials.slider')


    {{--<div class="home-info">
        <div class="container">

            <div class="row">
                @php $aboutChannel=$frontend_helper->getPagesById(3); @endphp
                <div class="col-lg-6 col-md-12 text-center">
                    <h2>{{$aboutChannel->nav_name}}</h2>
                    {!! $aboutChannel->short_content !!}
                    <a href="#" class="btn_link"> Read More</a>
                </div>
                @php $wholesalesite=$frontend_helper->getPagesById(5); @endphp
                <div class="col-lg-6 col-md-12 text-center">
                    <h2>{{$wholesalesite->nav_name}}</h2>
                    {!! $wholesalesite->short_content !!}
                    <a href="#" class="btn_link"> Read More</a>
                </div>
            </div>

            @php $welcome=$frontend_helper->getPagesById(4); @endphp
            <div class="row" style="justify-content: space-around;margin-top: 62px">
                <div class="col-lg-6 col-md-12 ">
                    <h2>{{$welcome->nav_name}}</h2>
                    {!! $welcome->short_content !!}
                </div>
            </div>

        </div>

    </div>--}}


    <section class="home-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 mt-4">
                    <h2 class="section-title">CATEGORIES</h2>
                </div>
            </div>
            @php $categoryhomelists = $category_Helper->getCategorylist(50); @endphp
            <div class="row">
                @foreach($categoryhomelists as $category)
                    @if($category->thumbnail)
                    <div class="col-lg-3 col-md-3 col-sm-12 cat-box-outer">
                        <div class="box">
                            <img src="{{ Image::make(public_path('uploads/category/'.$category->thumbnail),'thumb-category')->toUrl() }}"
                                 width="100%"/>
                           {{-- <div class="overlay-border"></div>--}}
                            <div class="product-overlay">
                                <div class=""><a href="{{route('category.pages',$category->slug)}}">View </a></div>
                            </div>
                        </div>
                        <a href="{{route('category.pages',$category->slug)}}"><h4
                                    class="cat-title">{{$category->code}}</h4></a>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

@endsection