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
                                <li><a href="{{route('user.account')}}"><i class="fa fa-user"></i>Personal Information</a></li>
                                <li ><a href="{{route('user.myOrders')}}"><i class="fa fa-shopping-cart"></i>My Order</a></li>
                                <li  class="active"><a href="{{route('user.account.changePassword')}}"><i class="fa fa-lock"></i>Change Password</a></li>
                                <li><a href="{{route('user.logout')}}"><i class="fa fa-sign-out"></i>Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 col-xs-12">
                    <div class="col-xs-12 col-sm-8">
                        <div class="contact_form">
                            <h3>Change Password</h3>
                            <div role="form" class="wpcf7">

                                <form action="{{route('user.account.updatePassword')}}" method="post" class="wpcf7-form">
                                    {{csrf_field()}}

                                    <p><label>Old Password : <br>
                                            <input type="text" name="old_password" class="wpcf7-form-control wpcf7-text"  required>
                                        </label>
                                    </p>
                                    <p><label>New Password : <br>
                                            <input type="password"  name="password" class="wpcf7-form-control wpcf7-text"  >
                                        </label>
                                    </p>

                                    <p><label>Confirm Password : <br>
                                            <input type="password" name="password_confirmation" class="wpcf7-form-control wpcf7-text" >
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