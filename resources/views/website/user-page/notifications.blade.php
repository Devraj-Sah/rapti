@extends('website.layouts.app')
@section('content')


    <section class="mt-5">

        <div class="container">
            <div class="row user-profile_content">
                <div class="col-sm-3 col-xs-12">
                    <div class="left-sidebar">
                        <div class="account-info"><h3 class="text-left">My Account</h3>

                            <ul class="nav nav-pills">
                                <li ><a href="{{route('user.account')}}"><i class="fa fa-user"></i>Personal Information</a></li>
                                <li ><a href="{{route('user.myOrders')}}"><i class="fa fa-shopping-cart"></i>My Order</a></li>
                                <li class="active"><a href="{{route('user.notifications')}}"><i class="fa fa-bell"></i>Notifications</a></li>
                                <li><a href="{{route('user.account.changePassword')}}"><i class="fa fa-lock"></i>Change Password</a></li>
                                <li><a href="{{route('user.logout')}}"><i class="fa fa-exclamation"></i>&nbsp Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 col-xs-12">
                    <div class="col-xs-12 col-sm-8">
                        <div class="contact_form">
                            <h3>Notifications</h3>
                            @forelse($orders as $order)
                            <div class="order  mb-2">
                                <div class="order-info ">
                                    <div class="pull-left">                                       
                                        <p class="text info desc">Placed on {{$order->created_at}}</p>
                                    </div>

    
                                </div>
                                @forelse($order->orderProduct as $orderProduct)
    
                                    @php $product = \App\Models\Product::findOrFail($orderProduct->product_id); @endphp
                                    <div class="order-item">
                                        <div class="item-pic" data-spm="detail_image">
                                            <a href="#">
                                                <img src="{{ Image::make(public_path('uploads/products/'.$product->thumbnail),'order-list')->toUrl() }}"
                                                     alt=""/>
                                            </a>
                                        </div>
                                        <div class="item-main item-main-mini">
    
                                            <p>{{$product->name}}</p>
    
    
                                        </div>
                                        <div class="item-quantity"><span><span
                                                        class="text desc info multiply">Qty:</span><span
                                                        class="text">&nbsp;{{$orderProduct->qty}}</span></span></div>
                                        <div class="item-status item-capsule"><p
                                                    class="capsule">{{$order->orderStatus->title}}</p></div>
                                        <div class="item-info">
                                            {{-- <p class="text delivery-success">Delivered on 14 Nov 2020</p> --}}
                                        </div>
    
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        @empty
                        @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection