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

                        <div class="page-content">
                            <h2>{{$model->nav_name}}</h2>

                            <ul class="catalogue" style="display: flex;">

                            @forelse($model->childs as $item)
                                    <li style=" margin-right: 3px"><a href="{{route('catalogue',$item->id)}}" target="_blank"><img src="{{asset('website/images/pdf-icon.png')}}" width="30px" alt=""/> {{$item->nav_name}}</a></li>

                                @empty
                                @endforelse
                            </ul>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection