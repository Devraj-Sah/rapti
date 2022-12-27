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
                <div class="col-lg-6">
                    {!! Form::open(['route'=>'cart.checkout.address.store','method'=>'POST']) !!}

                    <h2>Billing Details</h2>
                    <div class="row">
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('company_name', 'Company Name') !!}
                                {!! Form::text('company_name', $value = null, ['id'=>'text','placeholder'=>'Company Name','class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('name', 'Name') !!}
                                {!! Form::text('name', $value = null, ['id'=>'name','placeholder'=>'Name','class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('address_line_1', 'Address Line 1') !!}
                                {!! Form::text('address_line_1', $value = null, ['id'=>'address_line_1','placeholder'=>'Address Line 1','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('address_line_2', 'Address Line 2 ') !!}
                                {!! Form::text('address_line_2', $value = null, ['id'=>'address_line_2','placeholder'=>'Address Line 2','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('country', 'Country') !!}
                                {!! Form::text('country', $value = null, ['id'=>'country','placeholder'=>'Country','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('city', 'City') !!}
                                {!! Form::text('city', $value = null, ['id'=>'city','placeholder'=>'City','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('state', 'State') !!}
                                {!! Form::text('state', $value = null, ['id'=>'state','placeholder'=>'State','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('zip_code', 'Postal Code') !!}
                                {!! Form::text('zip_code', $value = null, ['id'=>'zip_code','placeholder'=>'Zip Code','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('phone', 'Phone Number') !!}
                                {!! Form::text('phone', $value = null, ['id'=>'phone','placeholder'=>'Phone Number','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('email', 'Email') !!}
                                {!! Form::email('email', $value = null, ['id'=>'email','placeholder'=>'Email','class'=>'form-control']) !!}

                            </div>
                        </div>
                    </div>

                    <h2>Shipping address</h2>
                    <div class="row mb-3">
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input checkbox_check" name="shiping_address" id="shiping_address">
                                <label class="form-check-label " >Same as Above</label>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="shipping_detail">
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('ship_company_name', 'Company Name') !!}
                                {!! Form::text('ship_company_name', $value = null, ['id'=>'text','placeholder'=>'Company Name','class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('ship_name', 'Name') !!}
                                {!! Form::text('ship_name', $value = null, ['id'=>'name','placeholder'=>'Name','class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('ship_address_line_1', 'Address Line 1') !!}
                                {!! Form::text('ship_address_line_1', $value = null, ['id'=>'ship_address_line_1','placeholder'=>'Address Line','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('ship_address_line_2', 'Address Line 2 ') !!}
                                {!! Form::text('ship_address_line_2', $value = null, ['id'=>'address_line_2','placeholder'=>'Address Line 2','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('ship_country', 'Country') !!}
                                {!! Form::text('ship_country', $value = null, ['id'=>'country','placeholder'=>'Country','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('ship_city', 'City') !!}
                                {!! Form::text('ship_city', $value = null, ['id'=>'city','placeholder'=>'City','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('ship_state', 'State') !!}
                                {!! Form::text('ship_state', $value = null, ['id'=>'state','placeholder'=>'State','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('ship_zip_code', 'Postal Code') !!}
                                {!! Form::text('ship_zip_code', $value = null, ['id'=>'zip_code','placeholder'=>'Zip Code','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('ship_phone', 'Phone Number') !!}
                                {!! Form::text('ship_phone', $value = null, ['id'=>'phone','placeholder'=>'Phone Number','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('ship_email', 'Email') !!}
                                {!! Form::email('ship_email', $value = null, ['id'=>'email','placeholder'=>'Email','class'=>'form-control']) !!}

                            </div>
                        </div>
                    </div>











                    <div class="spacer"></div>

                    <h2>Payment Details</h2>

                    <div class="form-group">
                        <div class="form-check">
                            {!! Form::radio('payment_type', 'cash_on_delivery', true,['class'=>'form-check-input']) !!}

                            <label class="form-check-label">
                                Cash On Delivery
                            </label>
                        </div>
                        {{--<div class="form-check">
                            {!! Form::radio('payment_type', 'esewa', false,['class'=>'form-check-input']) !!}
                            <label class="form-check-label" for="flexRadioDefault2">
                                E-Sewa
                            </label>
                        </div>--}}
                    </div>


                    <button type="submit" id="complete-order" class="button-primary full-width">Complete Order
                    </button>

                    {!! Form::close() !!}
                </div>
                <div class="col-lg-6">
                    <div class="checkout-table-container">
                        <h2>Your Order</h2>

                        <div class="cart-table">

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th class="thumb"></th>
                                        <th class="name">Product Name Details</th>
                                        <th class="qty">Quantity</th>
                                        <th class="price">Price</th>
                                        <th class="amount">Amount</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($carts as $item)
                                        <tr>

                                            <td class="thumb">
                                                <figure>
                                                    <img src="{{asset('uploads/products/'.$item->options->image ) }}"
                                                         alt="">
                                                </figure>
                                            </td>
                                            <td class="name">
                                                {{$item->name}}
                                            </td>
                                            <td class="qty">
                                                {{$item->qty}}
                                            </td>
                                            <td class="amount">NRs {{ number_format($item->price) }} </td>
                                            <td class="amount">NRs {{ number_format($item->price * $item->qty) }} </td>

                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>


                        </div> <!-- end cart-table -->

                        <div class="checkout-totals">
                            <div class="checkout-totals-left">
                                {{--Subtotal <br>--}}
                                {{--Tax (13%)<br>--}}
                                <span class="checkout-totals-total">Total</span>

                            </div>

                            <div class="checkout-totals-right">
                               {{-- NRs {{$subTotal}}<br>--}}
                                {{--NRs {{$tax}} <br>--}}
                                <span class="checkout-totals-total"> NRs {{$subTotal}}</span>

                            </div>
                        </div> <!-- end checkout-totals -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>

    $('input.checkbox_check').change(function()
    {

        if ($(this).is(':checked')) {
            // Do something...
            $('#shipping_detail').hide();
        }else {
            $('#shipping_detail').show();
        }

    });
</script>
@endsection