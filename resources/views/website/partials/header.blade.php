<header>
    <div class="hitStore_topheader">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 hitStore_topheader_left">
                    <div class="top_menu_wrapper">
                        <ul class="hitStore_top_menu">
                            <li><a href=""><i class="icofont-location-pin"></i>{{$settings->address}}  </a></li>
                            <li><a href=""><i class="icofont-phone"></i> {{$settings->phone}}  </a></li>
                            <li><a href=""><i class="icofont-envelope"></i> {{$settings->site_email}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6  hitStore_topheader_right">
                    <ul class="hitstore_socialmeida_link">
                        @if($settings->facebook_link)
                            <li>
                                <a href="{{$settings->facebook_link}}">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                        @endif
                        @if($settings->twitter_link)
                            <li>
                                <a href="{{$settings->twitter_link}}">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                        @endif
                        @if($settings->instagram_link)
                            <li>
                                <a href="{{$settings->instagram_link}}">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        @endif
                        @if($settings->youtube_link)
                            <li>
                                <a href="{{$settings->youtube_link}}">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="hitStore_mainheader">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="logo site-branding">

                        <a @if(\Illuminate\Support\Facades\Auth::check())
                           href="{{url('/home')}}"
                           @else
                           href="{{url('/')}}"
                           @endif class="custom-logo-link">   @if($settings->site_logo)
                                <img src="{{asset('uploads/icons/'.$settings->site_logo)}}" class="custom-logo"
                                     alt="Rapti Fashion">
                            @else
                                <img src="{{asset('website/images/web_logo.png')}}" class="custom-logo"
                                     alt="Rapti Fashion">
                            @endif
                        </a>


                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="header_search_form">
                        {!! Form::open(['route'=>'search.products','method'=>'get']) !!}
                        <div class="search-box-border">
                            <div class="header_select_cata">


                                <input class="search-input form-control " name="q"  placeholder="Search Product" />
                            </div>

                            <button type="submit" class="header_product_search"><i class="fas fa-search"></i>
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="htStore_ecommerce_extra_button">
                        <div class="hitStore_user_account">
                            <div class="hitStore_user_account_icon">
                                <span><i class="fa fa-user"></i></span>

                            </div>
                            <div class="user_account_menu_dropdown" style="left: -40px;">
                                @if(\Illuminate\Support\Facades\Auth::guard('web')->check())

                                    @if(\Illuminate\Support\Facades\Auth::guard('web')->check())
                                        <div class="hitStore_account_menu_list">
                                            <div class="hitStore_signIn hitstore_login">
                                                <a href="#"
                                                   class=" hitStore_login_button">Hi! {{\Illuminate\Support\Facades\Auth::guard('web')->user()->name}}</a>
                                            </div>
                                            <ul>
                                                <li><a href="{{route('user.account')}}">My Account</a></li>
                                                <li><a href="{{route('user.logout')}}">Logout</a></li>
                                            </ul>
                                        </div>
                                    @else
                                        <div class="hitStore_signIn hitstore_login">
                                            <a href="#" data-toggle="modal" data-target="#loginModal"
                                               class=" hitStore_login_button">Login</a>
                                            <a href="#signupModal" data-toggle="modal" data-target="#signupModal"  class="hitStore_signIn_button">Join</a>
                                        </div>
                                    @endif
                                @else
                                    <div class="hitStore_signIn hitstore_login">
                                        <a href="#" data-toggle="modal" data-target="#loginModal"
                                           class=" hitStore_login_button">Login</a>
                                        <a href="#signupModal" data-toggle="modal" data-target="#signupModal" class="hitStore_signIn_button">Join</a>
                                    </div>
                                @endif


                            </div>
                        </div>
                        <div class="hitStore_user_cart">
                            <div class="hitStore_cart_icon">
                                <span><i class="icofont-cart-alt"></i></i>

                                    @if(Cart::count())
                                        <div class="cart_count">
                                            {{ Cart::count() }}
                                        </div>
                                    @endif
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav id="site-navigation" class="main-navigation">
        <div class="container">
            <button class="main-menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i
                        class="fa fa-bars"></i></button>
            <div class="main-menu-container-collapse">
                <ul id="primary-menu" class="menu nav-menu" aria-expanded="false">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <li><a href="{{url('/')}}">Home</a></li>
                    @else
                        <li><a href="{{url('/')}}">Home</a></li>
                    @endif

                    @foreach($menus as $menu)
                        @if($menu->alias != 'contact-us')
                            @if(count($menu->childs))

                                @if( $menu->id == 6   )
                                    <li>
                                        <a href="{{route('pages',$menu->alias)}}">{{$menu->nav_name}}</a>
                                    </li>
                                @else
                                    <li class="menu-item-has-children">
                                        <a href="{{route('pages',$menu->alias)}}">{{$menu->nav_name}}</a>
                                        <ul class="sub-menu">

                                            @php $child = $frontend_helper->childMenu($menu->id) @endphp

                                            @foreach($child as $childMenu)
                                                @if(count($childMenu->childs))

                                                    <li class="menu-item-has-children ">
                                                        <a href="{{route('pages',$childMenu->alias)}}">{{$childMenu->nav_name}}</a>
                                                        <ul class="sub-menu">

                                                            @php $subChild = $frontend_helper->childMenu($childMenu->id) @endphp
                                                            @foreach($subChild as $superChildMenu)
                                                                <li>
                                                                    <a href="{{ route('pages',$superChildMenu->alias) }}">{{$superChildMenu->nav_name}}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>

                                                @else
                                                    <li>
                                                        <a href="{{route('pages',$childMenu->alias)}}">{{$childMenu->nav_name}}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @else
                                <li><a href="{{route('pages',$menu->alias)}}">{{$menu->nav_name}}</a></li>
                            @endif
                        @else
                        @endif
                    @endforeach


                    {{--@if(\Illuminate\Support\Facades\Auth::check())--}}
                    <li>
                        <a href="{{route('product.list.home')}}">Products</a>
                        {{--<ul class="sub-menu">

                            @foreach($categories as $category)

                                @if(count($category->childs))
                                    <li class="menu-item-has-children">
                                        <a href="{{route('category.pages',$category->slug)}}">{{$category->name}}</a>
                                        <ul class="sub-menu">
                                            @foreach($category->childs as $firstLevelMenu)
                                                @if(count($firstLevelMenu->childs))
                                                    <li class="menu-item-has-children">
                                                        <a href="{{route('category.pages',$firstLevelMenu->slug)}}">{{$firstLevelMenu->name}}</a>
                                                        <ul class="sub-menu">
                                                            @foreach($firstLevelMenu->childs as $secondLevelMenu)
                                                                @if(count($secondLevelMenu->childs))
                                                                    <li class="menu-item-has-children">
                                                                        <a href="{{route('category.pages',$secondLevelMenu->slug)}}">{{$secondLevelMenu->name}}</a>
                                                                        <ul class="sub-menu">
                                                                            @if(count($secondLevelMenu->childs))
                                                                                @foreach($secondLevelMenu->childs as $thirdLevelMenu)
                                                                                    <li>
                                                                                        <a href="{{route('category.pages',$thirdLevelMenu->slug)}}">{{$thirdLevelMenu->name}}</a>
                                                                                    </li>
                                                                                @endforeach
                                                                            @endif
                                                                        </ul>
                                                                    </li>
                                                                @else
                                                                    <li>
                                                                        <a href="{{route('category.pages',$secondLevelMenu->slug)}}">{{$secondLevelMenu->name}}</a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{route('category.pages',$firstLevelMenu->slug)}}">{{$firstLevelMenu->name}}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{route('category.pages',$category->slug)}}">{{$category->name}}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>--}}
                    </li>
                    {{--  @else

                      @endif--}}


                    <li><a href="{{route('website.contact-us')}}">Contact Us</a></li>
                </ul>

            </div>
        </div>
    </nav>
</header>

<style>
    .twitter-typeahead{
        width: 100%;
    }
    .search-input{
        padding: 19px 8px;
        font-size: 16px;
    }
    .tt-dataset{
        background: #FFF;
        padding: 3px 5px;
        border: 1px solid #000;
    }
    .tt-suggestion{
        border-bottom: 1px solid #cbcaca;
        padding: 6px 0;
    }
     .alert-item-added{
         display: flex;
         align-items: center;
         background: #FFF;
         padding: 8px 7px;
         position: fixed;
         right: 0;
         top:20%;
         z-index: 99999;
         border: 1px solid #ced4da;
         box-shadow: 1px 1px 5px 0px rgba(0,0,0,0.4);
     }
    .alert-item-added .icon{
        width: 45px;
        font-size: 35px;
    }
    .alert-item-added .close{
        position: absolute;
        top: -9px;
        left: -9px;
        box-shadow: 1px 1px 5px 0px rgba(0,0,0,0.4);
        border-radius: 100%;
        background: #e50000;
        color: #FFF;
        padding: 2px;
        cursor: pointer;
    }
    .alert-item-added .content button{
        padding: 5px 8px;
        width: 100%;
    }
</style>
