<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ResetPasswordPage extends Component
{
    use LivewireAlert;
    public $email;
    public $token;
    public $password;
    public $password_confirmation;
    public $errMessage;

    public function mount($token=null)
    {
        // dd( $token);
        // $this->email = $email;
        $this->email = request('email');
        $this->token = $token;
    }

    public function resetPassword()
    {
        // dd($this->email, $this->token);
        $validatedData = $this->validate([
            'token' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:5|confirmed',
        ]);
// dd("yes");
        $status = Password::reset(
            ['email' => $this->email, 'password' => $this->password, 'password_confirmation' => $this->password_confirmation, 'token' => $this->token],
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            $this->flash('success', 'The password has been reset successfully.!', [
                'position' => 'bottom-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
                'text' => '',
            ]);
            return $this->redirect('/login', navigate: true);
        } else {
            $this->errMessage = 'Failed to reset password';
        }
    }

    public function render()
    {
        return view('livewire.auth.reset-password-page');
    }
}
