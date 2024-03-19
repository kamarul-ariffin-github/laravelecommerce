<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Mail\OrderCreated;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CheckoutPage extends Component
{
    use LivewireAlert;
    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $city;
    public $state;
    public $zip_code;
    public $payment_method = 'cod';
    public $cart_items = [];
    public $grand_total;

    public function mount()
    {
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }

    public function placeOrder()
    {
        $validatedData = $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
        ]);

        //create order
        $order = new Order();
        $order->user_id = Auth::id();
        $order->grand_total = $this->grand_total;
        $order->payment_method = $this->payment_method;
        $order->currency = 'MYR';
        $order->status = 'new';
        $order->payment_status = 'pending';
        $order->shipping_amount = 0;
        // $order->shipping_method = 'jnt';
        $order->notes = '';
        $order->save();

        // Create address
        $address = new Address();
        $address->order_id = $order->id;
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip_code = $this->zip_code;
        $address->save();

        // Create order items
        foreach ($this->cart_items as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['product_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->unit_amount = $item['unit_amount'];
            $orderItem->total_amount = $item['total_amount'];
            $orderItem->save();
        }

        // Clear the cart after placing the order
        CartManagement::clearCartItems();

        //mails
        $url = 'http://127.0.0.1:8000/my-orders/' . $order->id;
        Mail::to(Auth::user()->email)->send(new OrderCreated($order, $url));

        $this->flash('success', 'Order created successfully, please check your email!', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => '',
        ]);

        return $this->redirect('/success/' . $order->id, navigate: true);
    }
}
