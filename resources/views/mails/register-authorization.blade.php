@php
    $base_url = $data['base_url'];
    if (preg_match('/^http:\/\/(127\.0\.0\.1|localhost)/', $base_url)) {
        $url = 'http://rapti.demo.radiantnepal.info/';
    }
    else{
        $url =  $base_url;
    }
    if(isset($data['mailto1'])){
        $mailto = $data['mailto1'];
    }
    else{
        $mailto = $data['mailto2'];
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
                <th colspan="" style="border: 1px solid black; padding:15px">Company</th>
                <th colspan="" style="border: 1px solid black; padding:15px">Email</th>
                <th colspan="" style="border: 1px solid black; padding:15px">Address1</th>
                <th colspan="" style="border: 1px solid black; padding:15px">Address2</th>
                <th colspan="" style="border: 1px solid black; padding:15px">City</th>
                <th colspan="" style="border: 1px solid black; padding:15px">State</th>
                <th colspan="" style="border: 1px solid black; padding:15px">Zip</th>
                <th colspan="" style="border: 1px solid black; padding:15px">Country</th>
                <th colspan="" style="border: 1px solid black; padding:15px">Phone</th>
            </tr>
        </thead>
            <tr style="border: 1px solid black;">

                <td rowspan="" colspan="2" style="padding:15px">{{ $data['name'] }}</td>
                <td style="border: 1px solid black; padding:15px">{{ $data['company'] }}</td>
                <td style="border: 1px solid black; padding:15px">{{ $data['email'] }}</td>
                <td style="border: 1px solid black; padding:15px">{{ $data['address'] }}</td>
                <td style="border: 1px solid black; padding:15px">{{ $data['address_2'] }}</td>
                <td style="border: 1px solid black; padding:15px">{{ $data['city'] }}</td>
                <td style="border: 1px solid black; padding:15px">{{ $data['state'] }}</td>
                <td style="border: 1px solid black; padding:15px">{{ $data['zip'] }}</td>
                <td style="border: 1px solid black; padding:15px">{{ $data['country'] }}</td>
                <td style="border: 1px solid black; padding:15px">{{ $data['phone'] }}</td>

            </tr>
    </table>

    <p> <b> Click This button to authoize this user to access in your website. </b><br>
      
    </p>
    <p style="text-align:center">
        <a href="{{$url}}authorize?token={{$data['token']}}&id={{$data['user_id']}}&email={{$mailto}}">
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