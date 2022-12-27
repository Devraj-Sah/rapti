



<li  ><a href="{{route('order.show',['id'=>$notification->data['order']['id']])}}">
        @php $customer = \App\User::findOrFail($notification->data['order']['customer_id']) @endphp
       {{$customer->name}} has made a New Order at {{$customer->created_at}}
    </a></li>

