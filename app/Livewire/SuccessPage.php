<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class SuccessPage extends Component
{
    public $order;

    public function mount($order)
    {
        $this->order = Order::findOrFail($order);
    }

    public function render()
    {
        return view('livewire.success-page');
    }
}
