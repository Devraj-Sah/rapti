<section class="hitStore_main_new_arrivals grey_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="position: relative">
                <h2 class="section-title">Latest products</h2>
            </div>
        </div>
        <div class="row">
            @if($latest_products)
                @foreach($latest_products->take(12) as $latestProduct)
                    <div class="col-lg-3 col-md-6  col-sm-12">
                        <div class="box">
                            <div class="product-list-inner">
                                <div class="product-listing">
                                    <figure>
                                        @if($latestProduct->thumbnail)
                                            <a href="{{route('pages.details',$latestProduct->slug)}}" class="img">
                                                <img src="{{Image::make('uploads/products/'.$latestProduct->thumbnail,'thumbnail')->toUrl()}}"
                                                     alt="Product Image">
                                            </a>
                                        @endif
                                    </figure>
                                    <div class="product-content">
                                        <div class="product-category-title">
                                            <h5 class="product-title">
                                                <a href="{{route('pages.details',$latestProduct->slug)}}">{{ $latestProduct->name }}</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>