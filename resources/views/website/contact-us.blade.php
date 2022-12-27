@extends('website.layouts.app')
@section('content')
    <section class="breadcrumb">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 breadcrumb_wrapper">
                    <h2 class="entry-title">Contact Us</h2>
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
                                                itemprop="name">Contact Us</span></span>
                                    <meta itemprop="position" content="2">
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <div class="fitness-page contact_form_page">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-12 contact-icon">
                    <h3>CONTACT DETAIL</h3>
                    <div class="contact-icon">
                        <div class="contact-inner">
                            <div class="box">
                                <div class="icon-box">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="text">
                                    <p>{{$settings->website_full_address}}</p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="icon-box">
                                    <i class="fas fa-phone-volume"></i>
                                </div>
                                <div class="text">
                                    <p>{{$settings->phone}}</p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="icon-box">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="text">
                                    <p>{{$settings->site_email}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <h3>CONTACT DETAIL</h3>
                    <div class="contact_form">
                        <div role="form" class="wpcf7">
                            <form action="" method="post" class="wpcf7-form">
                                <p>
                                    <label> Your Name (required)<br>
                                        <span class="wpcf7-form-control-wrap your-name">
                                            <input type="text" class="wpcf7-form-control wpcf7-text ">
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <label> Your Email (required)<br>
                                        <span class="wpcf7-form-control-wrap your-email">
                                            <input type="email" name="your-email" class="wpcf7-form-control wpcf7-text">
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <label> Subject<br>
                                        <span class="wpcf7-form-control-wrap your-subject">
                                            <input type="text" name="your-subject" value=""  class="wpcf7-form-control wpcf7-text">
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <label> Your Message<br>
                                        <span class="wpcf7-form-control-wrap your-message">
                                            <textarea name="your-message" class="wpcf7-form-control wpcf7-textarea"
                                              spellcheck="false"></textarea>
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <input type="submit" value="Send" class=" btn_link"><span  class="ajax-loader"></span>
                                </p>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="map mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>FIND US HERE </h3>
                </div>
            </div>
            <div class="embed-responsive embed-responsive-21by9">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.5156777231973!2d85.32239311548199!3d27.701360232360983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19a618ee5605%3A0xed8d2f23b4f287d9!2sFitness%20Choice!5e0!3m2!1sen!2snp!4v1597824530715!5m2!1sen!2snp"  frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
@endsection