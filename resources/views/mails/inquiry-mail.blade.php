<!doctype html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800"
          rel="stylesheet">

</head>

<body>
<h4>New Inquiry Request</h4>

<p>You have New Inquiry for Product : {{$data['product']?$data['product']:''}}</p>
<p>
    From<br>
    Name : {{$data['name']?$data['name']:''}} <br>
    Email : {{$data['email']?$data['email']:''}}<br>
    Phone : {{$data['phone']?$data['phone']:''}}<br>
    Message :{{$data['message']?$data['message']:''}}<br>
</p>
</body>
</html>

