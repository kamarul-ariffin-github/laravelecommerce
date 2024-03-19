<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPasswordPage extends Component
{
    public $email;
    public $message;
    public $errMessage;

    public function render()
    {
        return view('livewire.auth.forgot-password-page');
    }

    public function submit()
    {
        $this->message = null;
        $this->errMessage = null;

        $this->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->message = 'Password reset link sent! Please check your email.';
        } else {
            $this->errMessage = 'Something went wrong. Please try again later.';
        }
    }
}
