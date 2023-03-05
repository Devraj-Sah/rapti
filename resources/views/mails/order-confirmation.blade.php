@php
$customer = [];
$base_url = $base_url['base_url'];
if (preg_match('/^http:\/\/(127\.0\.0\.1|localhost)/', $base_url)) {
    $url = 'http://rapti.demo.radiantnepal.info/';
}
else{
    $url =  $base_url;
}

    // echo $base_url;
@endphp
@forelse($all as $order)
    @forelse ($order as $key=>$value)
        @php
            $customer[$key] = $value;
            // print($key);
        @endphp
    @empty
    @endforelse
@empty
@endforelse

<div id="conformation">
    <p><strong>Your <em>Rapti Fashion</em> Order Number <span style="color:#c0392b">ATC22{{ $customer['invoice_id'] }}</span> is Confirmed.</strong></p>
    
    <p><u><span style="font-size:20px"><strong>Order Confirmation</strong></span></u></p>
    

    {{-- <div style="display: flex;   margin-left:200px  ">
        <span style="color: green; font-weight: bold; margin-top: 15px;margin-left: 10px;"> Rapti Fashion </span>
    </div>
    <p><strong><span style="font-size:16px">Order Details</span><span style="font-size:14px">:</span> Order Number(<span
                style="color:#c0392b">ATC22{{ $customer['invoice_id'] }}</span>)</strong></p>
    <hr> --}}
    <div style="display: flex;">
        <ul>
            <li style="display: block; padding: 5px;">
                <span style="color: black; font-weight: bold;"> Order Date </span> <br>
                <span style="color: black;"> {{ date('d/m/Y') }} </span>
            </li>
            <li style="display: block; padding: 5px;">
                <span style="color: black; font-weight: bold;"> Payment method  </span> <br>
                <span style="color: black;"> {{ $customer['payment_type'] }} </span>
            </li>
            <li style="display: block; padding: 5px;">
                <span style="color: black; font-weight: bold;"> Shipping/ Billing address </span> <br>
                <span style="color: black;"> 
                    Company Name : {{ $customer['company_name'] }} <br>
                    Name    : {{ $customer['name'] }} <br>
                    Address Line 1 :{{ $customer['address_line_1'] }} <br>
                    Address Line 2 :{{ $customer['address_line_2'] }} <br>
                    City    :{{ $customer['city'] }}<br>
                    State    : {{ $customer['state'] }}<br>
                    Zip_code    :{{ $customer['zip_code'] }}<br>
                    Country    :{{ $customer['country'] }}<br>
                    Phone    :{{ $customer['phone'] }}<br>
                    Email    :{{ $customer['email'] }} 
                </span>

            </li>
        </ul>
    </div>
    <table style="border: 1px solid black; border-collapse:collapse; ">
        <thead>
            <tr style="border: 1px solid black;">
                <th scope="" colspan="" style="border: 1px solid black; padding:15px"></th>
                <th scope="" colspan="2" style="border: 1px solid black; padding:15px">Product Name</th>
                <th colspan="" style="border: 1px solid black; padding:15px">Item Code</th>
                <th scope="" style="border: 1px solid black; padding:15px">Color Code</th>
                <th colspan="" style="border: 1px solid black; padding:15px">Qty</th>
                <th colspan="" style="border: 1px solid black; padding:15px">Price</th>
            </tr>
        </thead>

        @php $order = \App\Models\Order::findOrFail($customer['order_id']); @endphp
        @foreach ($order->orderProduct as $orderProduct)
            {{-- {{$orderProduct}} --}}
            @php
                $product = \App\Models\Product::findOrFail($orderProduct->product_id);
            @endphp
            {{-- <img src="cid:product{{$orderProduct->product_id}}.jpg" alt=""/> --}}
            {{-- <img src="" alt=""> --}}
            <tr style="border: 1px solid black;">
                <td rowspan="" style="border: 1px solid black; padding:15px">{{ $loop->iteration }}</td>
                <td style="padding:15px"><img height="100"
                        src="{{$url}}uploads/products/{{ $product->thumbnail }}" width="100">
                </td>
                <td rowspan="" style="padding:15px">{{ $product->name }}</td>
                <td style="border: 1px solid black; padding:15px">{{ $product->category->code }}</td>
                <td style="border: 1px solid black; padding:15px">{{ $product->color_code }}</td>
                <td style="border: 1px solid black; padding:15px">{{ $orderProduct->qty }}</td>
                <td style="border: 1px solid black; padding:15px">${{ $product->price }}</td>
            </tr>
        @endforeach

        <tr style="border: 1px solid black;">
            <td rowspan=""></td>
            <td rowspan=""></td>
            <td>Total</td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $customer['total'] }}</td>
        </tr>
    </table>
    <p> <b> Donot reply to this email.This is auto generated email By machine. </b><br>
        If you want to contact us, Use this Button to redirect our Contact page. Thank You !!!
    </p>
    <p style="text-align:center">
        <a href="{{$url}}website/contact">
            <button type="button" class="btn btn-primary" style="
                    background-color: #007bff;
                    color: white;
                    border-color: #007bff;
                    padding: 5px 13px 5px 13px;
                    font-weight: 600;
                    cursor: pointer;
                ">Contact Us</button>
        </a>
    </p>
    <p style="margin-left:40px">Thank you for ordering from Rapti Fashion.</p>
    
    <p style="margin-left:40px">You can check you purchase order from Our website after you login with your account.</p>
    <p style="margin-left:40px">Under the <u>My account</u> -&gt; <u>My Order</u> section.</p>
</div>