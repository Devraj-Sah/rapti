

@extends('website.layouts.app')
@section('page_title', $product->meta_title)
@section('page_keyword', $product->meta_keywords)
@section('page_description', $product->meta_description)

@section('content')
    <section class="breadcrumb">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 breadcrumb_wrapper">
                    <h2 class="entry-title">{{$model->nav_name}}</h2>
                    <nav id="breadcrumb" class="fitness-park-breadcrumb">
                        <div class="breadcrumb-trail breadcrumbs" >
                            <ul class="trail-items" >

                                <li class="trail-item trail-begin"><a href="{{url('/')}}" rel="home" itemprop="item"><span >Home</span></a>

                                </li>
                                <li  class="trail-item trail-end"><span ><span >{{$model->nav_name}}</span></span>

                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <div class="page">
        <div class="container">
            <div style="background: #FFF;padding: 15px;" class="mb-5">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="section-title">{{$model->nav_name}}</h2>
                    </div>
                    <div class="col-lg-12">

                        <div class="page-content" style="display: flex;justify-content: space-around">

                            <div id="magazine">
                                @foreach($catalogues as $cata)
                                    <div style="background-image:url({{asset('uploads/banner_image/'.$cata->banner_image.'')}} "></div>

                                @endforeach
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection