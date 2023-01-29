{{--<footer id="colophon" class="site-footer">
    <div class="upper-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div id="categories-4" class="widget widget_contact">
                        <div class="logo mb-5">
                            @if($settings->site_logo)
                                <img src="{{asset('uploads/icons/'.$settings->site_logo)}}" class="custom-logo"
                                     alt="OM Surgical">
                            @else
                                <img src="{{asset('website/images/logo-1.png')}}" class="custom-logo" alt="OM Surgical">
                            @endif
                        </div>
                        <ul>
                            <li><a href="#"><i class="fas fa-map-marker-alt"></i> {{$settings->website_full_address}}
                                </a>
                            </li>
                            <li><a href="#"><i class="fas fa-phone-volume"></i>+ {{$settings->phone}}</a></li>
                            <li><a href="#"><i class="far fa-envelope"></i> {{$settings->site_email}}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div id="categories-4" class="widget widget_contact">
                        <h2 class="widget-title">ABOUT US</h2>
                        <ul>
                            <li><a href="#">Contact Us</a>
                            </li>
                            <li><a href="#">About</a>
                            </li>
                            <li><a href="#">We Deliver Almost Anywhere!</a>

                            </li>
                            <li><a href="#">Privacy Policy</a>
                            </li>
                            <li><a href="#">Terms of Service</a>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div id="categories-4" class="widget widget_contact">
                        <h2 class="widget-title">CATEGORIES</h2>
                        @php $categories = $frontend_helper->getAllCategories() @endphp
                        <ul>
                            @if($categories)
                                @foreach($categories->take(5) as $category)
                                    <li><a href="{{route('category.pages',$category->slug)}}">{{$category->name}}</a></li>
                                @endforeach
                            @endif
                        </ul>

                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                    <div id="categories-4" class="widget widget_contact">
                        <h2 class="widget-title">HELP & INFORMATION</h2>
                        <ul>
                            <li><a href="#">Privacy Policy</a>
                            </li>
                            <li><a href="#">Terms of Use</a>
                            </li>
                            <li><a href="#">Privacy Policy</a>

                            </li>
                            <li><a href="#">We Deliver Almost Anywhere!</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lower-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <p class="copyright">All Right Reserved 2020. OmSurgical Concern . Powered By: <a href="https://radiantnepal.com/" target="_blank">Radiant InfoTech Nepal</a></p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <ul class="social-media">
                        @if($settings->facebook_link)
                            <li>
                                <a href="{{$settings->facebook_link}}">
                                    <i class="fab fa-facebook"></i>
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
                        <li>
                            <a href="#">
                                <i class="fab fa-google"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</footer>--}}

<footer class="hitStore_footer">
    <div class="hitStore_main_footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12 footer-widget">
                    <aside class="widget  widget_product_categories">
                        <h3 class="widget-title links-title">COMPANY</h3>
                        <ul class="product-categories">

                            <li class="cat-item cat-item-5"><a href="#">Shipping and Delivery</a>
                            </li>
                            <li class="cat-item cat-item-6"><a
                                        href="{{ route('website.contact-us')}}">About</a>
                            </li>
                            <li class="cat-item cat-item-7"><a
                                        href="#">Top Pics</a>
                            </li>


                        </ul>
                    </aside>
                </div>

                <div class="col-md-3 col-sm-12  footer-widget">
                    <aside class="widget  widget_product_categories">
                        <h3 class="widget-title links-title">Customer Care</h3>
                        <ul class="product-categories">

                            <li class="cat-item cat-item-5"><a href="#">Help Center</a>
                            </li>
                            <li class="cat-item cat-item-6"><a href="#">How to Buy</a>
                            </li>
                            <li class="cat-item cat-item-7"><a href="{{  route('user.myOrders') }}">Track Your Order</a>
                            </li>
                            <li class="cat-item cat-item-8"><a href="#">Returns & Refunds</a>
                            </li>
                            <li class="cat-item cat-item-10"><a href="#">Contact Us</a>
                            </li>
                            <li class="cat-item cat-item-11"><a href="#">buying</a>
                            </li>
                        </ul>
                    </aside>

                </div>

                <div class="col-md-3 col-sm-12 footer-widget">
                    <aside class="widget  widget_product_categories">
                        <h3 class="widget-title links-title">POLICIES</h3>
                        <ul class="product-categories">

                            <li class="cat-item cat-item-5"><a href="#">TERMS
                                    AND CONDITIONS</a>
                            </li>
                            <li class="cat-item cat-item-6"><a
                                        href="#">RETURN AND
                                    REPLACEMENT POLICY</a>
                            </li>
                            <li class="cat-item cat-item-7"><a
                                        href="#">PRIVACY POLICY</a>
                            </li>


                        </ul>
                    </aside>
                </div>
                <div class="col-md-3 col-sm-12 footer-widget">
                    <aside class="widget  widget_product_categories">
                        <h3 class="widget-title links-title">Get Help</h3>
                        <ul class="product-categories">

                            <li class="cat-item cat-item-5"><a href="#">FAQ
                                    Section</a>
                            </li>
                            <li class="cat-item cat-item-6"><a
                                        href="#">Report the
                                    Incident</a>
                            </li>

                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <div class="hitStore_main_footer_copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <p class="left">©{{date('Y')}} AllRight Reserved. Aadit Trading Pvt Ltd.  Powered by <a href="#">
                            Radiant InfoTech
                        </a>

                    </p>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="payment_method right">
                        <img src="images/payment-support.png" alt=""/>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>


<!-- off menu page -->
<div class="offset__wrapper">
    <div class="body__overlay"></div>


    <div class="shopping__cart">
        <div class="shopping__cart__inner">
            <div class="offsetmenu__close__btn">
                <a href="#"><i class="fas fa-times"></i></a>
            </div>
            <div class="shp__cart__wrap">
                @forelse($carts as $item)

                    @php $product = \App\Models\Product::find($item->id);  @endphp
                <div class="shp__single__product">
                    <div class="shp__pro__thumb">
                        <a href="{{route('pages.details',$product->slug)}}">
                            <img src="{{asset('uploads/products/'.$item->options->image ) }}" alt="product images">
                        </a>
                    </div>
                    <div class="shp__pro__details">

                        <h2><a href="{{route('pages.details',$product->slug)}}">{{$item->name}}</a></h2>
                        <span class="quantity">QTY: {{$item->qty}}</span>
                        <span class="shp__price">  $: {{ number_format($item->price) }} </span>
                    </div>
                    <div class="remove__btn">
                        <a href="{{ route('cart.delete',['id'=>$item->rowId]) }}" title="Remove this item"><i class="fas fa-times"></i></a>
                    </div>
                </div>
                    @empty

                @endforelse
            </div>
            {{--<ul class="shoping__total">
                <li class="subtotal">Subtotal:</li>
                <li class="total__subtotal">Nrs: {{ Cart::subtotal() }} </li>
                <li class="subtotal">Tax:</li>
                <li class="total__tax">Nrs: {{ Cart::tax() }} </li>
                <li class="subtotal">Total:</li>
                <li class="total__price">Nrs: {{ Cart::total() }} </li>
            </ul>--}}
            <ul class="shopping__btn">
                <li><a href="{{route('cart.index')}}">View Cart</a></li>
                <li class="shp__checkout"><a href="{{route('cart.checkout')}}">Checkout</a></li>
            </ul>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Please Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('user.login.submit')}}" method="POST" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                    </div>
                    <a href="#ForgetModal" data-toggle="modal" data-target="#ForgetModal"  class="hitStore_signIn_button"><span class="text text-danger mt-5">Forget Password ?</span></a>
                    
                    <button type="submit" id="complete-order" class="button-primary" style="float: right">Login </button>
                </form>


            </div>
        </div>
    </div>
</div>

{{-- Forget Password --}}
<div class="modal fade" id="ForgetModal" tabindex="-1" aria-labelledby="ForgetModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ForgetModalLabel">Password Recovery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('user.forgetpassword')}}" method="GET" >
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>                    
                    
                    <button type="submit" id="complete-order" class="button-primary" style="float: right">Send token</button>
                </form>


            </div>
        </div>
    </div>
</div>

{{-- Enter password --}}
<div class="modal fade" id="enterresetpas" tabindex="-1" aria-labelledby="enterresetpas" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enterresetpasLabel">Password Recovery</h5>
                <button type="button" class="close close-reset" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container" style="width: auto; display:flex; justify-content:space-between ">
                    @if(Session::get('errors'))
                        <p class="alert alert-danger" style="width: 60%">                            
                                @foreach ($errors->all() as $error)
                                {{ $error }}  <br>           
                                @endforeach                                                                                 
                        </p>
                    @endif
                    @if($message = Session::get('sent_mail'))
                    <p class="alert alert-danger" style="width: 60%">                        
                            {{$message}}                               
                    </p>
                    @endif
                        <a href="{{route('user.forgetpassword', ['email' => Session::get('tempemail'),'again'=>'true'])}}">
                            <span class="badge bg-info p-2" style="color: white; margin-top:7px; margin-bottom:16px;"> 
                                send token again 
                            </span>
                        </a>
                    </div>         
                <form action="{{route('user.forgetpassword.gmail')}}" method="POST" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="token">Token sent to email</label>
                        <input type="text" class="form-control" id="email" name="token" placeholder="Token" required>
                    </div> 
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" id="email" name="password" placeholder="New Password" required>
                    </div>           
                    <div class="form-group">
                        <label for="confirm password"> Confirm Password</label>
                        <input type="password" class="form-control" id="email" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>              
                    
                    <button type="submit" id="complete-order" class="button-primary" style="float: right">Submit</button>
                </form>


            </div>
        </div>
    </div>
</div>
@if(Session::has('token'))
    <script>  
            $('#enterresetpas').css('display','block');
    </script>
@endif
<script>
    $('.close-reset').click(function() {
        if (confirm("Are you sure to Cancle Process ?")) {
            $.ajax({
            url: '/user/destroy-session',
            type: 'GET',
            success: function(result) {
                if (result.success) {
                    // console.log('Session destroyed successfully');
                    location.reload();
                }
            }
        });    
        } 
});
</script>

<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Please Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                    <form method="POST" action="{{route('users.register')}}" id="registerForm">
                        {{ csrf_field() }}
                        <div class="col-md-12 col-sm-12">
                            <label for="email">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Full Name" value="{{old('name')}}" required >
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{old('email')}}" required >
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label for="email">Password</label>
                            <input type="password" name="password" class="form-control" 
                                   placeholder="Password" required >
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label for="email">Conform Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="Confirm Password" required >
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <button type="submit" class="button-primary">Submit</button>
                        </div>
                    </form>


            </div>
        </div>
    </div>
</div>


