@php
    $customer = [];
    $base_url = $base_url['base_url'];
    if (preg_match('/^http:\/\/(127\.0\.0\.1|localhost)/', $base_url)) {
        $url = 'http://rapti.demo.radiantnepal.info/';
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

<div style="display: flex;   margin-left:200px  ">
    <span style="color: green; font-weight: bold; margin-top: 15px;margin-left: 10px;"> Rapti Fashion </span>
</div>
<p><strong><span style="font-size:16px">Order Details</span><span style="font-size:14px">:</span> Order Number(<span
            style="color:#c0392b">ATC22{{ $customer['invoice_id'] }}</span>)</strong></p>
<hr>
<div style="display: flex;">
    <ul>
        <li style="display: block; padding: 5px;">
            <span style="color: black; font-weight: bold;"> Billing Name: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['name'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Billing Email: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['email'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Billing Phone Number: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['phone'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Billing Country: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['country'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Billing City: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['city'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Billing CompanyName: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['company_name'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Billing Address_line_1: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['address_line_1'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Billing Address Line 2: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['address_line_2'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Billing State: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['state'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Billing Zip Code: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['zip_code'] }} </span>
        </li>
    </ul>
    <ul style="margin-left: 100px;">
        <li style="display: block; padding: 5px;">
            <span style="color: black; font-weight: bold;"> Ship Name: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['ship_name'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Ship Email: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['ship_email'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Ship Phone Number: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['ship_phone'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Ship Country: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['ship_country'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Ship City: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['ship_city'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Ship CompanyName: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['ship_company_name'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Ship Address_line_1: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['ship_address_line_1'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Ship Address Line 2: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['ship_address_line_2'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Ship State: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['ship_state'] }} </span>
        </li>
        <li style="display: block;padding: 5px;">
            <span style="color: black; font-weight: bold;"> Ship Zip Code: </span>
            <span style="color: black; font-weight: bold;"> {{ $customer['ship_zip_code'] }} </span>
        </li>
    </ul>
</div>
<table style="border: 1px solid black; border-collapse:collapse; ">
    <thead>
        <tr style="border: 1px solid black;">
            <th scope="" colspan="" style="border: 1px solid black; padding:15px"></th>
            <th scope="" colspan="2" style="border: 1px solid black; padding:15px">Product Name</th>
            <th scope="" style="border: 1px solid black; padding:15px">Color Code</th>
            <th colspan="" style="border: 1px solid black; padding:15px">Qty</th>
            <th colspan="" style="border: 1px solid black; padding:15px">Item Code</th>
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
            <td style="border: 1px solid black; padding:15px">{{ $product->color_code }}</td>
            <td style="border: 1px solid black; padding:15px">{{ $orderProduct->qty }}</td>
            <td style="border: 1px solid black; padding:15px">{{ $product->code }}</td>
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
<p> <b> If you accept the Order: </b><br>
    PLEASE ACKNOWLEDGE RECEIPT OF THIS ORDER BY CLICKING Acknowledge:
</p>
<p style="text-align:center">
    <a href="{{$base_url}}website/acknowledge?invoice=ATC22{{ $customer['invoice_id'] }}&email={{ $customer['email'] }}">
        <button type="button" class="btn btn-primary" style="
                background-color: #007bff;
                color: white;
                border-color: #007bff;
                padding: 5px 13px 5px 13px;
                font-weight: 600;
                cursor: pointer;
            ">Acknowledge</button>
    </a>
</p>
