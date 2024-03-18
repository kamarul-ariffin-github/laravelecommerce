<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class LoginPage extends Component
{
    public $email;
    public $password;
    public $errorMessage;

    public function render()
    {
        return view('livewire.auth.login-page');
    }

    public function login()
    {
        $this->errorMessage = null;
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:1',
        ], [
            'email.required' => 'Please include a valid email address so we can get back to you',
            'password.required' => '8+ characters required',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            // Authentication was successful
            $url = Session::pull('url.intended', '/');
            return $this->redirect($url, navigate: true);
        } else {
            // Authentication failed
            $this->errorMessage = 'Invalid credentials';
        }
    }
}
