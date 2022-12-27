<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel | User Login</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/bootstrap/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/admin_custom.css')}}" />
    <link rel="icon" type="image/png" href="{{asset('assets/img/fav.png')}}" sizes="16x16">

    <script type="text/javascript" src="{{asset('assets/admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>
</head>
<body style="background-color: #a3d7ff;">
<div class="container">
    <div class="row">
        <div id="login_box" class="col-md-offset-4 col-md-4">
            <h3>ADMIN LOGIN</h3>
            <form method="post" action="{{url('/admin/login')}}">
                {{csrf_field()}}
                <div class="form-group">

                    <input type="name" class="form-control" name="name" id="name" placeholder="Username">
                </div>
                <hr/>
                <div class="form-group">

                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>

                <hr/>
                <button type="submit" name="login" class="btn btn-success"><i class="fa fa-lock"></i> LogIn</button>
            </form>
        </div>
        <div class="col-md-offset-4 col-md-4">
            <br/>
            <p style="text-align: center;">Copyright &copy;<script>document.write(new Date().getFullYear());</script> | All rights reserved <br><a href="https://radiantnepal.com" target="_blank">Radiant InfoTech Nepal</a></p>
        </div>
    </div>
</div>
</body>
</html>
