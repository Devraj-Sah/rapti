@extends('website.layouts.app')
@section('content')



    @include('website.partials.slider')



    <section class="hitStore_category_with_banner">
        <div class="container">
            <div class="row" style="background: #FFF">
                <div class="col-lg-12 col-md-12 mt-4">
                    <h2 class="section-title">About Rapti Fashion</h2>
                    <p>Rapti is the one stop destination for the world’s best and largest collection for shawls and
                        scarves. We present an exquisite range made by using a variety of fabrics, designs, patterns &
                        techniques. A combination of style and elegance our range is available in a spectrum of designs
                        and colors. A blend of tradition, imagination and trends the collection is legacy of generations
                        working with textures and trends.<br/><br/>

                        We offer warmth and sophistication with a distinctive, artistic and elegant collection which is
                        offered at most competitive factory direct prices.<br/><br/>

                        We have been in business for over a decade now. We have over three thousand customers and one of
                        the keys for our growth has been its unmatched customer service. Our aim is to have our clients
                        satisfied.</p>
                </div>

            </div>


        </div>


    </section>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="section-title">Latest Catalogue</h2>
            </div>
            <div class="col-lg-12">
                <div style="display: flex; justify-content: space-around">
                    @php $catalogueLatest = $frontend_helper->getLatestChild(6);
                         $catalogue = $frontend_helper->getNavigationListByParent($catalogueLatest->id);

                    @endphp
                    <div id="magazine">
                        @foreach($catalogue as $cata)
                        <div style="background-image:url({{asset('uploads/banner_image/'.$cata->banner_image.'')}} "></div>

                        @endforeach
                    </div>
                </div>
            </div>

        </div>

    </div>
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