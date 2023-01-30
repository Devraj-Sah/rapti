@extends('website.layouts.app')
@section('content')



    @include('website.partials.slider')


    <!-- overlay catlog  -->
    <style>
        .overlay {
          height: 100%;
          width: 100%;
          display: none;
          position: fixed;
          z-index: 99;
          top: 0;
          left: 0;
          background-color: rgb(0,0,0);
          background-color: rgba(0,0,0, 0.9);
          overflow-x: hidden;
          transition: 0.5s;
        }

        .overlay-content {
          position: relative;
          top: 7%;
          width: 100%;
          text-align: center;
          margin-top: 30px;
        }
        
        .overlay a {
          padding: 8px;
          text-decoration: none;
          font-size: 36px;
          color: #818181;
          display: block;
          transition: 0.3s;
        }
        
        .overlay a:hover, .overlay a:focus {
          color: #f1f1f1;
        }
        
        .overlay .closebtn {
          position: absolute;
          top: 20px;
          right: 45px;
          font-size: 60px;
        }
        
        @media screen and (max-height: 450px) {
          .overlay a {font-size: 20px}
          .overlay .closebtn {
          font-size: 40px;
          top: 15px;
          right: 35px;
          }
        }
    </style>
    <div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn">&times;</a>
        <div class="overlay-content">
            <div class="col-lg-12">
                <div style="display: flex; justify-content: space-around">
                    @php 
                        $catalogueLatest = $frontend_helper->getNavigationListByParent($_GET['id']);
                    @endphp
                    <div id="magazine" >
                        @foreach($catalogueLatest as $cata)
                        <img src=" {{asset('uploads/banner_image/'.$cata->banner_image.'')}}" style="width:100%">

                        @endforeach
                    </div>
                </div>
                <div id="dev" class="row" style="display: flex; justify-content:center">
                    <div id="" >
                        <button class="rounded-5 evendev">Prev</button>
                    </div>
                    <div class="ml-5 " >
                        <button class="rounded-5 odddev">Next</button>
                    </div>
                </div>
            </div>     
        </div>
    </div>



    <!-- end overlay catlog  -->

    
    <div class="container">
        <div class="row" style="justify-content: center">
            <div class="col-lg-12">
                <h2 class="section-title">Latest Catalogue</h2>
            </div>
            @php 
                $catalogueLatest1 = $frontend_helper->getNavigationListByParent(6);
                // echo "<pre>";
                //         print_r($catalogueLatest1->all())
            @endphp
            @foreach ($catalogueLatest1 as $catalogueLatest)
                    <div style="display: none" id="iteration{{$loop->iteration}}">{{$catalogueLatest->id}}</div>
                    <div class="col-lg-4"  id="opencat{{$loop->iteration}}" >
                        <div style="display: flex; justify-content: space-around; flex-direction:column">
                            
                                @foreach($catalogueLatest->childs as $cata)                                                   
                                    {{-- {{$cata->id}}                                                         --}}
                                    <img class="img-fluid" src="{{asset('uploads/banner_image/'.$cata->banner_image.'')}}">
                                    @break($loop->iteration == 1)
                                @endforeach
                                <div id="dev" class="row" style="display: flex; justify-content:center; margin-top:15px">
                                    <div id="" >
                                        <button class="rounded-5 evendev open{{$loop->iteration}}" style="border-radius: 30px">Open Catlog</button>
                                        <a href="{{route('category.pages',$frontend_helper->getCatlogSlugById($catalogueLatest->extra_three))}}">
                                            <button class="rounded-5 evendev" style="border-radius: 30px">View Category</button>
                                        </a>
                                    </div>
                                </div>
                        </div>                
                    </div>     
            @endforeach
            {{-- <div class="col-lg-4" onclick="openNav()" >
                <div style="display: flex; justify-content: space-around; flex-direction:column">
                    @php 
                        $catalogue = $frontend_helper->getfirstCatlog(16);

                        // $catalogueLatest = $frontend_helper->getfirstCatlog(16,2);
                        //  $catalogue = $frontend_helper->getNavigationListByParent($catalogueLatest->id);

                    @endphp
                        @foreach($catalogue as $cata)                        
                            <img class="img-fluid" src="{{asset('uploads/banner_image/'.$cata->banner_image.'')}}">
                            @break($loop->iteration == 1)
                        @endforeach
                        <div id="dev" class="row" style="display: flex; justify-content:center; margin-top:15px">
                            <div id="" >
                                <button onclick="openNav()" class="rounded-5 evendev" style="border-radius: 30px">Open Catlog</button>
                            </div>
                        </div>
                </div>                
            </div>    --}}
            <script>
                $(document).ready(function() {
                    $get_orginal = window.location.search;
                    $get_wanted = $get_orginal.split("=")[0];
                    if($get_wanted == "?id"){
                     $(".overlay").show();
                    }
                });
                
                $(".open1").click(function(){
                    // $(".overlay").show();
                    // alert(window.location.search)
                    $id = $("#iteration1").text();
                    var currentUrl = window.location.origin;
                    window.location.href = currentUrl+"?id="+$id;
                });
                
                $(".open2").click(function(){
                    $id = $("#iteration2").text();
                    var currentUrl = window.location.origin;
                    window.location.href = currentUrl+"?id="+$id;
                });
                $(".closebtn").click(function(){
                    $(".overlay").hide();
                    // window.location.href =  window.location.origin;
                });
            </script> 
            {{-- <div class="col-lg-6">
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
                <div id="dev" class="row" style="display: flex; justify-content:center">
                    <div id="" >
                        <button class="rounded-5 evendev">Prev</button>
                    </div>
                    <div class="ml-5 " >
                        <button class="rounded-5 odddev">Next</button>
                    </div>
                </div>
            </div>          --}}
        </div>
        <script>
            $(function() {
                $(document).on("click", "#dev .evendev", function(event) {
                $("#magazine").turn("previous");
                });

                $(document).on("click", " #dev .odddev", function(event) {
                $("#magazine").turn("next");
                });

                });
        </script>

    </div>

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

    {{-- <section class="home-product">
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
                               <div class="overlay-border"></div>
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
    </section> --}}
@endsection