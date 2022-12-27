<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderStatus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class OrderController extends Controller
{
    public function __construct(Request $request,Order $order)
    {

        $this->request = $request;
        $this->model = $order;
    }


    public function index()
    {
        $orders  = $this->model->all();

        return view('admin.order.index',[
            'orders' => $orders
        ]);
    }


    public function show($id)
    {


        $data['order'] = $this->model->find($id);

        $data['orderStatuses'] = OrderStatus::pluck('title', 'id');

        foreach (auth()->user()->unreadNotifications as $notification){
            if($notification->data['order']['id'] == $data['order']['id']){
                $notification->markAsRead();
            }

        }

        return view('admin.order.show', $data);
    }


    public function create()
    {
        return view('admin.order.create');
    }

    /*public function store(Request $request)
    {
        $data = $request->all();

        $this->validate($request, [
            'category_id' => 'required|not_in:0',
            'name' =>'required',
            'thumbnail.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'featured_image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $model = $this->model->create($data);



        return redirect()->route('order.index')->with('message','Record was successfully saved!!');
    }*/

    public function edit($id)
    {
        $model = $this->model->find($id);
        return view('admin.order.edit',['model' =>$model]);
    }

    public function updateStatus(Request $request)
    {
        $input = $request->all();

        try {

            //$all['created_by_id'] = auth()->user()->id;
            //$this->orderHistory->save($all);

            //Update Order Status too
            $order = $this->model->findOrFail($input['order_id']);

            $order->status_id = $input['status_id'];
            $order->save();

            return redirect()->back()->with('success','Status was successfully saved!!');

        } catch (\Throwable $t) {
            return redirect()->back()->with('error','There was some error');
        }
    }


    public function update(Request $request, $id)
    {
        $order = $this->model->findOrFail($id);

        $data = $request->all();

        $this->validate($request, [
            'category_id' => 'required|not_in:0',
            'name' =>'required',
            'thumbnail.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'featured_image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $order->update($data);
        return redirect(route("order.index"))->with('message', 'Record was successfully Update!!');
    }

    public function destroy($id)
    {
        $order = $this->model->findOrFail($id);
        $order->delete();
        return redirect(route("order.index"))->with('message', 'Record was successfully Deleted!!');
    }







}
