@extends('website.layouts.app')
@section('content')
    <section class="breadcrumb">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 breadcrumb_wrapper">
                    <h2 class="entry-title">{{$model->nav_name}}</h2>
                    <nav id="breadcrumb" class="fitness-park-breadcrumb">
                        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs"
                             itemprop="breadcrumb">
                            <ul class="trail-items" itemscope="" itemtype="http://schema.org/BreadcrumbList">

                                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"
                                    class="trail-item trail-begin"><a href="{{url('/')}}" rel="home"
                                                                      itemprop="item"><span
                                                itemprop="name">Home</span></a>
                                    <meta itemprop="position" content="1">
                                </li>
                                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"
                                    class="trail-item trail-end"><span itemprop="item"><span
                                                itemprop="name">{{$model->nav_name}}</span></span>
                                    <meta itemprop="position" content="2">
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="fitness-page">
        <div class="container">
            <div style="background: #FFF;padding: 15px;" class="mb-5">
                <div class="row">
                    <div class="col-lg-12">
                        @if($model->banner_image)
                            <figure>
                                <img src="{{asset('uploads/banner_image/'.$model->banner_image)}}" alt=""/>
                            </figure>
                        @endif
                        <p class="mt-5">{!! $model->long_content !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection