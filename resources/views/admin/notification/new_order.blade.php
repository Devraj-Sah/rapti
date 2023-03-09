



<li  ><a href="{{route('order.show',['id'=>$notification->data['order']['id']])}}">
        @php $customer = \App\User::findOrFail($notification->data['order']['customer_id']) @endphp
        @if (isset($customer))
            
        {{$customer->name}} has made a New Order at {{$customer->created_at}}
        @endif
    </a></li>

