<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MyOrdersPage extends Component
{
    use WithPagination;

    public function render()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->paginate(10);

        return view('livewire.my-orders-page', [
            'orders' => $orders
        ]);
    }
}
