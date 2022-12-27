@extends('website.layouts.app')
@section('page_title', 'Aadit Trading')
@section('page_keyword', 'Handicraft')
@section('page_description', 'Handmade Products')

@section('content')
    <style>
        .form-check-label {
            margin-bottom: 0;
            margin-left: 20px;
        }

        .form-check-input {
            margin-top: 7px;
        }
    </style>
    <div class="checkout-section">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">

                    <div class="success">
                        <h2 class="title">Thank you for the Purchase</h2>
                        <div class="orderNum">Your order number is <span>RM2100001</span></div>
                        <h4>SHIPPING ADDRESS</h4>
                        <ul>
                            <li>Avinesh Shakya</li>
                            <li>shakyaavinesh@gmail.com</li>
                            <li></li>
                            <li>patan</li>
                            <li>Mobile: <span>9843802891</span></li>
                        </ul>
                        <div class="shop mt-5"><a href="{{route('website.home')}}" class="button-primary">Continue Shopping</a></div>
                    </div>





                </div>
            </div>
        </div>
    </div>
@endsection

