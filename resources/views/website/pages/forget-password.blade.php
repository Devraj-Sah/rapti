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
                                    class="trail-item trail-begin"><a href="{{url('/')}}" rel="home" itemprop="item"><span
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
    <section class="fitness-page forget-password">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="loginModalLabel">Reset Password</h5>

                                </div>
                                <div class="modal-body">
                                    <form>

                                        <div class="col-md-12 col-sm-12">
                                            <input type="text" class="wpcf7-form-control wpcf7-text " placeholder="Email">
                                        </div>

                                        <div class="col-md-12 col-sm-12">
                                            <input type="password" class="wpcf7-form-control wpcf7-text "
                                                   placeholder="Password">
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <input type="password" class="wpcf7-form-control wpcf7-text "
                                                   placeholder="Conform Password">
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <button type="button" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection