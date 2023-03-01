<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use MailImage;

class orderDetailMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data, $base_url;
    public $all;

    public function __construct($data,$all,$base_url)
    {
        $this->data = $data;
        $this->all = $all;
        $this->base_url = $base_url;
    }

    /**
     * Build the message.base_url
     *
     * @return $this
     */
    public function build()
    {       
        // $images = [];        
        // $order = \App\Models\Order::findOrFail($this->mailorderid);
        // foreach($order->orderProduct as $orderProduct)
        // {
        //     $product = \App\Models\Product::findOrFail($orderProduct->product_id); 
        //     $image = MailImage::make(public_path('uploads/products/'.$product->thumbnail));
        //     $images[] = [
        //         'data' => $image->encode(),
        //         'name' => 'product' . $orderProduct->product_id . '.jpg',
        //         'mime' => 'image/jpeg',
        //     ];
    
        // }
    
        // foreach ($images as $image) {
        //     $this->attachData($image['data'], $image['name'], [
        //         'mime' => $image['mime'],
        //     ]);
        // }

        return $this->view('mails.order-detail')->replyTo('order@raptifashiondirect.com', 'Rapti Fashion')->subject('New Order !!!');
    }
}
