<?php

namespace App\Livewire\Auth;

use App\Mail\AccountRegistered;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class RegisterPage extends Component
{
    public $name;
    public $email;
    public $password;

    public function register()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        //mails
        Mail::to($user->email)->send(new AccountRegistered($user));

        // Authenticate the user
        Auth::login($user);

        // Redirect to a page after registration
        return $this->redirect('/', navigate: true);
    }
    
    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
