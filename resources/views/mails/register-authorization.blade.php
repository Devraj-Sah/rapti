@php
    $base_url = $data['base_url'];
    if (preg_match('/^http:\/\/(127\.0\.0\.1|localhost)/', $base_url)) {
        $url = 'http://rapti.demo.radiantnepal.info/';
    }
    else{
        $url =  $base_url;
    }
@endphp
<div id="conformation">
    <p><strong>One New member Registered in <em>Rapti Fashion</em> </strong></p>  
    
    <!-- Order Number <span style="color:#c0392b">ATC22{{$data['invoice']}}</span> is Confirmed. -->
    
    <p><u><span style="font-size:20px"><strong>User Authorization</strong></span></u></p>
    <table style="border: 1px solid black; border-collapse:collapse; ">
        <thead>
            <tr style="border: 1px solid black;">
                <th scope="" colspan="2" style="border: 1px solid black; padding:15px">User Name</th>
                <th colspan="" style="border: 1px solid black; padding:15px">Email</th>
            </tr>
        </thead>
            <tr style="border: 1px solid black;">

                <td rowspan="" style="padding:15px">{{ $data['name'] }}</td>
                <td style="border: 1px solid black; padding:15px">{{ $data['email'] }}</td>

            </tr>
    </table>

    <p> <b> Click This button to authoize this user to access in your website. </b><br>
      
    </p>
    <p style="text-align:center">
        <a href="{{$url}}authorize?token={{$data['token']}}&id={{$data['user_id']}}">
            <button type="button" class="btn btn-primary" style="
                    background-color: #007bff;
                    color: white;
                    border-color: #007bff;
                    padding: 5px 13px 5px 13px;
                    font-weight: 600;
                    cursor: pointer;
                ">Authorize</button>
        </a>
    </p>
    <p style="margin-left:40px">Contact Developer Using this link: <a href="https://www.facebook.com/devraj.2022/">@Devraj</a></p>
    
    <p style="margin-left:40px">You can check you purchase order from Our website after you login with your account.</p>
    
    <p style="margin-left:40px">Under the <u>My account</u> -&gt; <u>My Order</u> section.</p>
</div>