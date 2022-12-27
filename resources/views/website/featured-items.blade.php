<section class="hitStore_main_new_arrivals grey_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="section-title">Featured Items</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 featured_items">
                @if($featured_products)
                    @foreach($featured_products as $product)
                        <div class="box">
                            <div class="product-list-inner">
                                <div class="product-listing">
                                    <figure>
                                        @if($product->thumbnail)
                                            <a href="{{route('pages.details',$product->slug)}}" class="img">
                                                <img src="{{Image::make('uploads/products/'.$product->thumbnail,'thumbnail')->toUrl()}}"
                                                     alt="Product Image">
                                            </a>
                                        @endif
                                    </figure>
                                    <div class="product-content">
                                        <div class="product-category-title">
                                            <h5 class="product-title">
                                                <a href="{{route('pages.details',$product->slug)}}">{{ $product->name }}</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>