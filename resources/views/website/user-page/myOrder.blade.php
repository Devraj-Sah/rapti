@extends('website.layouts.app')
@section('content')


    <section class="mt-5">

        <div class="container">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row user-profile_content">
                <div class="col-sm-3 col-xs-12">
                    <div class="left-sidebar">
                        <div class="account-info"><h3 class="text-left">My Account</h3>

                            <ul class="nav nav-pills">
                                <li><a href="{{route('user.account')}}"><i class="fa fa-user"></i>Personal
                                        Information</a></li>
                                <li class="active">
                                    <a href="{{route('user.myOrders')}}">
                                        <i class="fa fa-shopping-cart"></i>
                                            @if($Countorders == 1)
                                                <div class="cart_count" style="background: #04c4d9; font-size:15px ">
                                                    &nbsp <b>{{$Countorders}}</b>
                                                </div>
                                            @endif
                                        My Order
                                    </a>
                                </li>
                                {{-- <li><a href="{{route('user.notifications')}}"><i class="fa fa-bell"></i>Notifications</a></li> --}}
                                <li><a href="{{route('user.account.changePassword')}}"><i class="fa fa-lock"></i>Change
                                        Password</a></li>
                                <li><a href="{{route('user.logout')}}"><i class="fa fa-exclamation"></i>&nbspSign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 col-xs-12">


                    <h3>My Orders</h3>
                    @forelse($orders as $order)
                        <div class="order  mb-2">
                            <div class="order-info ">
                                <div class="pull-left">
                                    <div class="info-order-left-text">Order <a class="link"> {{$order->invoice_id}}</a>
                                    </div>
                                    <p class="text info desc">Placed on {{$order->created_at}}</p>
                                </div>
                                <div>
                                    <a href="{{route('user.orderDetail',$order->id)}}" class="pull-right link manage" style="color: rgb(26, 156, 183);">MANAGE</a>
                                </div>

                            </div>
                            @forelse($order->orderProduct as $orderProduct)

                                @php $product = \App\Models\Product::findOrFail($orderProduct->product_id); @endphp
                                <div class="order-item">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="item-pic" data-spm="detail_image">
                                                <a href="#">
                                                    <img src="{{ Image::make(public_path('uploads/products/'.$product->thumbnail),'order-list')->toUrl() }}"
                                                         alt=""/>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-8">
                                            <div class="row"  style="display: flex; flex-direction:column">
                                                <div class="row" style="flex-wrap: unset" >
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
                                                @if ($order->is_notify == 1)
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                               <style>
                                                                    .devdev {
                                                                        position: absolute;
                                                                        top: 0;
                                                                        right: 0;
                                                                        z-index: 2;
                                                                        padding: 1.25rem 1rem;
                                                                    }
                                                                    </style>                                                                    
                                                                <div class="alert alert-success alert-dismissible fade show">
                                                                    <strong>Message Releated To Your Product :</strong> <br>
                                                                    {{ $order->messages }}
                                                                    <a href="{{route('user.removenotifications',$order->id)}}">
                                                                        <i class="fa fa-times devdev"></i>
                                                                    </a>
                                                                   
                                                                </div>                                     
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                            
                                        </div>
                                        </div>
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
    </section>


@endsection