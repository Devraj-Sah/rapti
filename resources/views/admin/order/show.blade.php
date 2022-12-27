@extends('admin.layout.master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/DataTables/datatables.min.css')}}">
@endsection

@section('content')
    <!-- main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-weight: bold;margin-bottom: 10px;">
                            Order List
                        </h3>
                        <div class="clearfix"></div>
                        <div class="col-sm-9">
                            @include('admin.flash-message')
                        </div>
                    </div> <!-- /.box-header -->

                    <div class="box-body ">


                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4 class="text-semibold no-margin-top">{{ strtoupper($address->type) }}
                                                ADDRESS</h4>
                                            <ul class="list list-unstyled">
                                                <li>INVOICE:</li>
                                                <li>Name:</li>
                                                <li>Email:</li>
                                                <li>Mobile:</li>
                                                <li>Address:</li>
                                                <li>District:</li>
                                                <li>City:</li>
                                                <li>Zip Code:</li>
                                                <li>Status:</li>
                                            </ul>
                                        </div>

                                        <div class="col-sm-6">
                                            <h6 class="text-semibold text-right no-margin-top">&nbsp;</h6>
                                            <ul class="list list-unstyled text-right">
                                                <li><span class="text-semibold"
                                                          style="color:deeppink;font-size:15px;">{{ $order->orderAddress->order->invoice_id }}</span>
                                                </li>
                                                <li><span class="text-semibold"
                                                          style="color:Green;font-size:18px;">{{ $order->orderAddress->name }}</span>
                                                </li>
                                                <li><span class="text-semibold">{{ $order->orderAddress->email }}</span>
                                                </li>
                                                <li><span class="text-semibold"
                                                          style="color:darkblue;font-size:18px;">{{ $order->orderAddress->mobile }}</span>
                                                </li>
                                                <li>
                                                    <span class="text-semibold">{{ $order->orderAddress->address }}</span>
                                                </li>
                                                <li>
                                                    <span class="text-semibold">{{ $order->orderAddress->district }}</span>
                                                </li>
                                                <li><span class="text-semibold">{{ $order->orderAddress->city }}</span>
                                                </li>
                                                <li>
                                                        <span class="text-semibold">@if($order->orderAddress->zip_code) {{$order->orderAddress->zip_code}} @else
                                                                ------------------ @endif</span></li>
                                                <li><span class="text-semibold"
                                                          style="color:red;font-size:18px;">{{ ucwords($order->orderAddress->order->orderStatus->title) }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>

                                    <th>Qty</th>
                                    <th>Price/Unit</th>
                                    <th>Price</th>

                                    <th>Order Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($order->orderProduct as $orderProduct)
                                    <tr>
                                        <td>{{$orderProduct->id}}</td>
                                        <td>{{$orderProduct->product->name}}</td>
                                        <td>{{$orderProduct->qty}}</td>
                                        <td>Rs. {{$orderProduct->product->price}}/-</td>
                                        <td>Rs. {{$orderProduct->product->price * $orderProduct->qty}}/-</td>
                                        <td>{{$orderProduct->created_at}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <p class="text-danger text-center">No data found !</p>
                                        </td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="4" align="right">
                                        Sub Total
                                    </td>
                                    <td colspan="2">
                                        Rs. {{ $order->sub_total }}/-
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4" align="right">
                                        Tax
                                    </td>
                                    <td colspan="2">
                                        Rs. {{ $order->tax }}/-
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4" align="right">
                                        Flat Shipping
                                    </td>
                                    <td colspan="2">
                                        {{ $order->shipping_rate }}
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4" align="right">
                                        Total
                                    </td>
                                    <td colspan="2">
                                        Rs. {{ $order->total }}/-
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-weight: bold;margin-bottom: 10px;">
                            ORDER HISTORY
                        </h3>
                        <div class="clearfix"></div>
                        <div class="col-sm-9">
                            @include('admin.flash-message')
                        </div>
                    </div> <!-- /.box-header -->

                    <div class="box-body ">
                        <div class="col-lg-12">
                            {!! Form::open(['method'=>'POST','class'=>'form-horizontal','role'=>'form','route'=>'order.history.update']) !!}

                            {!! Form::hidden('order_id',$order->id) !!}
                            <fieldset>
                                <div class="form-group">
                                    {!! Form::label('name', 'Name', ['class' => 'col-md-2 control-label required_label']) !!}
                                    <div class="col-md-4">
                                        {!! Form::select('status_id',$orderStatuses,null,['class'=>'form-control select','placeholder'=>'Select Statuses']) !!}
                                        <span class="text-danger">{{ $errors->first('status_id') }}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('is_notified', 'Notify Customer', ['class' => 'col-md-2 control-label required_label']) !!}
                                    <div class="col-md-4">
                                        Yes {!! Form::radio('is_notified',1) !!}
                                        No {!! Form::radio('is_notified',0,true) !!}
                                        <p class="text-danger">{{ $errors->first('is_notified') }}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('message', 'Message', ['class' => 'col-md-2 control-label required_label']) !!}
                                    <div class="col-md-8">
                                        {!! Form::text('message', $value = null, ['id'=>'message','placeholder'=>'Message','class'=>'form-control','style'=>'height:60px;width:600px;']) !!}
                                        <span class="text-danger">{{ $errors->first('message') }}</span>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-md-10 col-md-offset-2">
                                        {!! Form::submit('Save',['class'=>'btn btn-success btn-rounded legitRipple']) !!}
                                        <a href="{{ route('order.index') }}">
                                            {!! Form::button('Cancel',['class'=>'btn btn-warning btn-rounded legitRipple']) !!}
                                        </a>
                                    </div>

                                </div>

                            </fieldset>
                            <!-- /.col-lg-6 (nested) -->
                            {!! Form::close() !!}
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection

