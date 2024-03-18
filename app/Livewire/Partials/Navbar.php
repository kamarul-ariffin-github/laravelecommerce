<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $total_count = 0;
    public $isLoggedIn = false;
    public $name;

    public function mount(){
        $this->total_count = count(CartManagement::getCartItemsFromCookie());
        $this->isLoggedIn = Auth::check();
        if ($this->isLoggedIn) {
            $this->name = Auth::user()->name;
        }
    }

    public function logout()
    {
        Auth::logout();
        
        return $this->redirect('/', navigate: true);
    }

    #[On('update-cart-count')]
    public function updateCartCount($total_count){
        $this->total_count = $total_count;
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
