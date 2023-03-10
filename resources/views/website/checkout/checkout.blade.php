@extends('website.layouts.app')
@section('page_title', 'Rapti Fashion')
@section('page_keyword', 'Checkout')
@section('page_description', 'First add to Cart to CheckOut')

@section('content')
    <style>
        .form-check-label {
            margin-bottom: 0;
            margin-left: 20px;
        }

        .form-check-input {
            margin-top: 7px;
        }
        .form-group.required .control-label:after {
            content:"*";
            color:red;
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
                            <div class="form-group required">
                                {!! Form::label('company_name', 'Company Name',['class'=>'control-label']) !!}
                                {!! Form::text('company_name', $value = $user_data->company, ['id'=>'text','placeholder'=>'Company Name','class'=>'form-control','required']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group required">
                                {!! Form::label('name', 'Customer Name',['class'=>'control-label']) !!}
                                {!! Form::text('name', $value = $user_data->name, ['id'=>'name','placeholder'=>'Customer Name','class'=>'form-control','required']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group required">
                                {!! Form::label('address_line_1', 'Address Line 1',['class'=>'control-label']) !!}
                                {!! Form::text('address_line_1', $value = $user_data->address, ['id'=>'address_line_1','placeholder'=>'Address Line 1','class'=>'form-control','required']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('address_line_2', 'Address Line 2  (Optional)',['class'=>'control-label']) !!}
                                {!! Form::text('address_line_2', $value = $user_data->address_2, ['id'=>'address_line_2','placeholder'=>'Address Line 2','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group required">
                                {!! Form::label('city', 'City',['class'=>'control-label']) !!}
                                {!! Form::text('city', $value = $user_data->name, ['id'=>'city','placeholder'=>'City','class'=>'form-control','required']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group required">
                                {!! Form::label('state', 'State',['class'=>'control-label']) !!}
                                {!! Form::text('state', $value = $user_data->city, ['id'=>'state','placeholder'=>'State','class'=>'form-control','required']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group required">
                                {!! Form::label('zip_code', 'Zip Code',['class'=>'control-label']) !!}
                                {!! Form::text('zip_code', $value = $user_data->zip, ['id'=>'zip_code','placeholder'=>'Zip Code','class'=>'form-control','required']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group required">
                                {!! Form::label('country', 'Country',['class'=>'control-label']) !!}
                                {!! Form::text('country', $value = $user_data->country, ['id'=>'country','placeholder'=>'Country','class'=>'form-control','required']) !!}

                            </div>
                        </div>                     
                       
                       
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group required">
                                {!! Form::label('phone', 'Phone Number',['class'=>'control-label']) !!}
                                {!! Form::text('phone', $value = $user_data->phone, ['id'=>'phone','placeholder'=>'Phone Number','class'=>'form-control','required']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group required">
                                {!! Form::label('email', 'Email',['class'=>'control-label']) !!}
                                {!! Form::email('email', $value = $user_data->email, ['id'=>'email','placeholder'=>'Email','class'=>'form-control','required']) !!}

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
                            <div class="form-group required">
                                {!! Form::label('ship_company_name', 'Company Name',['class'=>'control-label']) !!}
                                {!! Form::text('ship_company_name', $value = null, ['id'=>'text','placeholder'=>'Company Name','class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group required">
                                {!! Form::label('ship_name', 'Customer Name',['class'=>'control-label']) !!}
                                {!! Form::text('ship_name', $value = null, ['id'=>'name','placeholder'=>'Customer Name','class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group required">
                                {!! Form::label('ship_address_line_1', 'Address Line 1',['class'=>'control-label']) !!}
                                {!! Form::text('ship_address_line_1', $value = null, ['id'=>'ship_address_line_1','placeholder'=>'Address Line','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group">
                                {!! Form::label('ship_address_line_2', 'Address Line 2 (Optional)',['class'=>'control-label']) !!}
                                {!! Form::text('ship_address_line_2', $value = null, ['id'=>'address_line_2','placeholder'=>'Address Line 2','class'=>'form-control']) !!}

                            </div>
                        </div>
                       
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group  required">
                                {!! Form::label('ship_city', 'City',['class'=>'control-label']) !!}
                                {!! Form::text('ship_city', $value = null, ['id'=>'city','placeholder'=>'City','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group  required">
                                {!! Form::label('ship_state', 'State',['class'=>'control-label']) !!}
                                {!! Form::text('ship_state', $value = null, ['id'=>'state','placeholder'=>'State','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group  required">
                                {!! Form::label('ship_zip_code', 'Zip Code',['class'=>'control-label']) !!}
                                {!! Form::text('ship_zip_code', $value = null, ['id'=>'zip_code','placeholder'=>'Zip Code','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group  required">
                                {!! Form::label('ship_country', 'Country',['class'=>'control-label']) !!}
                                {!! Form::text('ship_country', $value = null, ['id'=>'country','placeholder'=>'Country','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group  required">
                                {!! Form::label('ship_phone', 'Phone Number',['class'=>'control-label']) !!}
                                {!! Form::text('ship_phone', $value = null, ['id'=>'phone','placeholder'=>'Phone Number','class'=>'form-control']) !!}

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  col-sm-12">
                            <div class="form-group  required">
                                {!! Form::label('ship_email', 'Email',['class'=>'control-label']) !!}
                                {!! Form::email('ship_email', $value = null, ['id'=>'email','placeholder'=>'Email','class'=>'form-control']) !!}

                            </div>
                        </div>
                    </div>











                    <div class="spacer"></div>

                    <h2>Payment Details</h2>

                    <div class="form-group">
                        <div class="form-check">
                            {!! Form::radio('payment_type', 'Net 30 (est acct)', false,['class'=>'form-check-input']) !!}
                            <label class="form-check-label" for="flexRadioDefault2">
                                Net 30 (est acct)
                            </label>
                        </div>
                        <div class="form-check">
                            {!! Form::radio('payment_type', 'Use credit card authorized on file', false,['class'=>'form-check-input']) !!}
                            <label class="form-check-label" for="flexRadioDefault2">
                                Use credit card authorized on file
                            </label>
                        </div>
                        <div class="form-check">
                            {!! Form::radio('payment_type', 'Call for credit card', false,['class'=>'form-check-input']) !!}
                            <label class="form-check-label" for="flexRadioDefault2">
                                Call for credit card
                            </label>
                        </div>
                        <div class="form-check">
                            {!! Form::radio('payment_type', 'cash_on_delivery', true,['class'=>'form-check-input']) !!}

                            <label class="form-check-label">
                                Cash On Delivery
                            </label>
                        </div>                     
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
                                            <td class="amount">$ {{ number_format($item->price) }} </td>
                                            <td class="amount">$ {{ number_format($item->price * $item->qty) }} </td>

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
                               {{-- $ {{$subTotal}}<br>--}}
                                {{--$ {{$tax}} <br>--}}
                                <span class="checkout-totals-total"> $ {{$subTotal}}</span>

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