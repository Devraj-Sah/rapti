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
                                <li class="active"><a href="{{route('user.myOrders')}}"><i
                                                class="fa fa-shopping-cart"></i>My Order</a></li>
                                <li><a href="{{route('user.account.changePassword')}}"><i class="fa fa-lock"></i>Change
                                        Password</a></li>
                                <li><a href="{{route('user.logout')}}"><i class="fa fa-sign-out"></i>Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 col-xs-12">


                    <h3>My Orders</h3>

                    <div class="order  mb-5">
                        <div class="order-info ">
                            <div class="pull-left">
                                <div class="info-order-left-text">Order <a class="link"> {{$order->invoice_id}}</a>
                                </div>
                                <p class="text info desc">Placed on {{$order->created_at}}</p>
                            </div>
                            <div>
                                <a href="#" class="pull-right link manage"
                                   style="color: rgb(26, 156, 183);">Cancel Order</a>
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

                                    <p>{{$product->name}} </p>
                                    <p class="capsule">{{$order->orderStatus->title}}</p>


                                </div>
                                <div class="item-quantity"><span><span
                                                class="text desc info multiply">Qty:</span><span
                                                class="text">&nbsp;{{$orderProduct->qty}}</span></span></div>
                                <div class="item-status item-capsule"></div>
                                <div class="item-info"><p class="text delivery-success">Delivered on 14 Nov 2020</p>
                                </div>

                            </div>
                        @empty
                        @endforelse
                    </div>

                    <div class="row">

                        <div class="col-md-6 col-sm-12">
                            <div style="border: 1px solid #ddd; padding: 15px">
                                <h3>Billing Address</h3>

                                <p>{{$order->orderAddress->name}} <br>
                                    {{$order->orderAddress->address}} ,{{$order->orderAddress->city}}
                                    , {{$order->orderAddress->district}}, {{$order->orderAddress->zip_code}} <br>
                                    {{$order->orderAddress->mobile}}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div style="border: 1px solid #ddd; padding: 15px">
                                <h3>Total Summary</h3>
                                <div class="row" style="justify-content: space-between">
                                    <div class="col-md-6">Subtotal</div>
                                    <div class="col-md-6">Rs. {{   $order->sub_total}}</div>
                                </div>
                                <div class="row" style="justify-content: space-between">
                                    <div class="col-md-6">Tax 13%</div>
                                    <div class="col-md-6">Rs. {{   $order->tax }}</div>
                                </div>

                                <div class="row" style="justify-content: space-between">
                                    <div class="col-md-6">Total</div>
                                    <div class="col-md-6">Rs. {{  $order->total }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection