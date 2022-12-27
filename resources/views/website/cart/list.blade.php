@extends('website.layouts.app')
@section('page_title', 'Aadit Trading')
@section('page_keyword', 'Handicraft')
@section('page_description', 'Handmade Products')

@section('content')

    <div id="update-alert">
        {{--<div class="alert-item-added">
            <div class="icon"><i class="icofont-tick-boxed"></i></div>
            <div class="content">
                <h4>ITEM ADDED TO YOUR CART</h4>
                <button>View Cart</button>
            </div>
        </div>--}}
    </div>


    <section class="cart-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">


                    <h2> {{ Cart::count() }} item(s) in Shopping Cart</h2>

                    <div class="cart-table">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="thumb"></th>
                                    <th class="name">Item</th>
                                    <th class="qty">Quantity</th>
                                    <th class="price">Price</th>
                                    <th class="amount">Amount</th>
                                    <th class="delete"></th>
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
                                            <select class="quantity" data-id="{{ $item->rowId }}">
                                                @foreach([1,2,3,4,5,6,7,8,9,10,11,12,13,14] as $num)
                                                    <option value="{{ $num }}"
                                                            @if($item->qty==$num) selected @endif>{{ $num }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="amount">$ {{ number_format($item->price) }} </td>
                                        <td class="subtotal">$ {{ number_format($item->price * $item->qty) }} </td>
                                        <td class="delete">
                                            <a href="{{ route('cart.delete',['id'=>$item->rowId]) }}">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                            </table>
                        </div>


                    </div> <!-- end cart-table -->


                    <div class="cart-totals">
                        <div class="cart-totals-left">
                            {{-- Shipping is free because we’re awesome like that. Also because that’s additional stuff I
                             don’t feel like figuring out :).--}}
                        </div>

                        <div class="cart-totals-right">
                            <div>
                              {{--  Subtotal <br>--}}

                                <span class="cart-totals-total">Total</span>
                            </div>
                            <div class="cart-totals-subtotal">
                               {{-- Rs {{$subTotal}} <br>--}}
                               {{-- Rs {{$tax}} <br>--}}
                                <span class="cart-totals-total">$ {{$subTotal}}</span>
                            </div>
                        </div>
                    </div> <!-- end cart-totals -->

                    <div class="cart-buttons">
                        <a href="{{route('website.home')}}" class="button">Continue Shopping</a>
                        <a href="{{route('cart.checkout')}}" class="button-primary">Proceed to Checkout</a>
                    </div>


                </div>
            </div>
        </div>

    </section>



@endsection

@section('script')
    <script>

        $(document).ready(function () {

            var route = '{{route("cart.index")}}' ;
            $.each($(".quantity"), function (i, v) {

                $(v).change(function (e) {
                    e.preventDefault();

                    var Qty = $(this).val();
                    var Id = $(this).data('id');
                    var Url = "{!! route('cart.update') !!}";

                    Cart.update(Qty, Id, Url);

                });

            });

            Cart = {
                update: function (Qty, Id, Url) {

                    $.ajax({
                        type: "GET",
                        url: Url,
                        data: {qty: Qty, id: Id},
                        success: function (dt) {
                            //location.reload();
                            $('#update-alert').append('<div class="alert-item-added"><div class="close"> </div><div class="icon"><i class="icofont-tick-boxed"></i></div>' +
                                '<div class="content"><h4>' + dt.message + '</h4><button href="' +  route  + '">View Cart</button></div></div>');
                            $('.cart_count').empty().append(dt.cartCount);
                            setTimeout(function() {
                                $('.alert-item-added').fadeOut('fast');
                            }, 2000);
                            location.reload();

                        },
                        error: function (err) {
                            console.log('Error', err);
                        }
                    });
                }
            }
        });
    </script>
@endsection