<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email;
    public $password;
    public function render()
    {
        return view('livewire.login-component')->layout('components.Layout.login');
    }
    public function login()
    {
        //dd($this->email,$this->password);
        $user = User::where('email', $this->email)->first(); 

    // Agar foydalanuvchi topilsa
    if ($user) {
        if (Hash::check($this->password, $user->password)) {
            
            session()->put('user_id', $user->id); 
            session()->flash('success', 'Siz tizimga muvaffaqiyatli kirdingiz!');

            return redirect('/'); 
        } else {
            session()->flash('error', 'Parol noto\'g\'ri!');
            return back(); 
        }
    } else {
        session()->flash('error', 'Foydalanuvchi topilmadi!');
        return back();
    }
    }
}
