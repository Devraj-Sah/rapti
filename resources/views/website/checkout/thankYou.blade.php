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
                    <div class="checkout-from">
                        <div class="success">
                            <h2 class="title">Thank you for the Purchase</h2>
                            <div class="orderNum">Your order number is <span>ATC22{{ $random_token }}</span></div>
                            <div class="orderNum" style="font-size: 15px; font-weight: 700;">Order Date :<span style="color: black;">{{ date('d/m/Y') }}</span></div>
                            <h4 style=" color: #3ebfa4; font-weight: 800; ">SHIPPING ADDRESS</h4> <hr>
                            <div class="thanksname">
                                <ul style=" border-radius: 10px; ">
                                    <li>Company Name : {{ $all['company_name'] }} </li>
                                    <li>Name : {{ $name }} </li>
                                    <li>Address 1 : {{ $address1 }} </li>
                                    <li>Address 2 : {{ $address2 }} </li>
                                    <li>City : {{ $city }} </li>
                                    <li>State : {{ $all['state'] }} </li>
                                    <li>Zip Code : {{ $all['zip_code'] }} </li>
                                    <li>Country : {{ $all['country'] }} </li>
                                    <li>Phone No : {{ $phone }} </li>
                                    <li>Email : {{ $email }} </li>
                                    {{-- <li>Mobile: <span>{{ $phone }}</span></li> --}}
                                </ul>
                            </div>

                            <div class="shop mt-5"><a href="{{ route('website.home') }}" class="button-primary">Continue
                                    Shopping</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
