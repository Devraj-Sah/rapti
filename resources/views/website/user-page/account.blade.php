@extends('website.layouts.app')
@section('content')


    <section class="mt-5">

        <div class="container">
            <div class="row user-profile_content">
                <div class="col-sm-3 col-xs-12">
                    <div class="left-sidebar">
                        <div class="account-info"><h3 class="text-left">My Account</h3>

                            <ul class="nav nav-pills">
                                <li class="active"><a href="{{route('user.account')}}"><i class="fa fa-user"></i>Personal Information</a></li>
                                <li ><a href="{{route('user.myOrders')}}"><i class="fa fa-shopping-cart"></i>My Order</a></li>
                                <li><a href="{{route('user.account.changePassword')}}"><i class="fa fa-lock"></i>Change Password</a></li>
                                <li><a href="{{route('user.logout')}}"><i class="fa fa-sign-out"></i>Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 col-xs-12">
                    <div class="col-xs-12 col-sm-8">
                        <div class="contact_form">
                            <h3>PERSONAL INFORMATION</h3>
                            <div role="form" class="wpcf7">

                                <form action="{{route('user.account.update')}}" method="post" class="wpcf7-form">
                                    {{csrf_field()}}
                                    <p><label>Name :<br>

                                            <input type="text" name="name" class="wpcf7-form-control wpcf7-text " value="{{Auth::user()->name}}" required>

                                        </label>
                                    </p>
                                    <p>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="inlineRadio1">Gender</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                               value="Male" @if(Auth::user()->gender == 'Male') checked @endif>
                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                               value="Female"  @if(Auth::user()->gender == 'Female') checked @endif>
                                        <label class="form-check-label" for="inlineRadio2">Female</label>
                                    </div>

                                    </p>
                                    <p><label>Phone Number : <br>

                                            <input type="text" name="phone" class="wpcf7-form-control wpcf7-text" value="{{Auth::user()->phone}}" required>

                                        </label>
                                    </p>
                                    <p><label>Email : <br>
                                            <input type="text"  class="wpcf7-form-control wpcf7-text" value="{{Auth::user()->email}}" readonly>

                                        </label>
                                    </p>

                                    <p><label>Address : <br>
                                            <input type="text" name="address" class="wpcf7-form-control wpcf7-text" value="{{Auth::user()->address}}" required>
                                        </label>
                                    </p>

                                    <p><input type="submit" value="SAVE"></p>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection