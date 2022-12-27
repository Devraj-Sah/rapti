<section class="hitStore_category_with_banner">
    <div class="container">
        <div style="background: #FFF;">
            <div class="row no-gutters">
                @php $slider=$frontend_helper->getPagesBySlug('slider'); @endphp
                <div class="hitStore_main_slider" style="width: 100% ">

                    <div class="hitStoreslider hitStore_slider_list">
                        @forelse($slider->navigationitems as $item)
                            <div class="hitStore_slider_wrap ">
                                <div class="hitStoreslider_image">
                                    <img src="{{ Image::make(public_path('uploads/photo_gallery/'.$item->file),'banner-slider')->toUrl() }}" width="100%">
                                </div>
                                <div class="hitStore_slider_content banner_content_left left">
                                    <h3>{{$item->name}}</h3>
                                    <div class="hitStore_slider_button">
                                        <a href="{{route('product.list.home')}}">Shop Now Via Our catalogue</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                    </div>

                </div>
               {{-- <div class="hitStore_main_category_nav hitStore_category_nav_left">
                    @php $slide_banners=$category_Helper->getCategorySideBanner(); @endphp
                    @foreach($slide_banners as $slide_banner)
                        <div class="category_feature  mb-3 ">
                            <div class="box">
                                <a href="{{route('category.pages',$slide_banner->slug)}}">
                                    <img src="{{ Image::make(public_path('uploads/category/'.$slide_banner->thumbnail),'side-category')->toUrl() }}"
                                         alt=""/>
                                </a>

                                <div class="category-content">
                                    <h4 class="category-name text-uppercase">{{$slide_banner->name}}</h4>
                                    <span class="category-count">6  Products</span>
                                </div>
                                <a class="btn btn-underline btn-link"
                                   href="{{route('category.pages',$slide_banner->slug)}}">Shop Now</a>
                            </div>
                        </div>
                    @endforeach
                </div>--}}

            </div>
        </div>
    </div>

</section>

{{--

<section class="hitStore_promotion_banner">
    <div class="container">
        <div style="background: #FFF;">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="outer-border">
                        <div class="box">
                            <div class="info-icon">
                                <i class="icofont-shopping-cart"></i>
                            </div>
                            <div class="info-text">
                                <h4>PRODUCT DISCOUNT</h4>
                                <p>UP TO 20%</p>
                            </div>
                        </div>

                        <div class="box">
                            <div class="info-icon">
                                <i class="icofont-sale-discount"></i>
                            </div>
                            <div class="info-text">
                                <h4>SHIPPING DISCOUNTS</h4>
                                <p>Up to 20% OFF</p>
                            </div>
                        </div>

                        <div class="box">
                            <div class="info-icon">
                                <i class="icofont-fast-delivery"></i>
                            </div>
                            <div class="info-text">
                                <h4>LOGISTICS SERVICE</h4>
                                <p>On Time Delivery</p>
                            </div>
                        </div>

                        <div class="box">
                            <div class="info-icon">
                                <i class="icofont-live-support"></i>
                            </div>
                            <div class="info-text">
                                <h4>CUSTOMER SATISFACTION</h4>
                                <p>100%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>--}}
