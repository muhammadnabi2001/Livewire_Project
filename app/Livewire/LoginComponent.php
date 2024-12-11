<?php

namespace App\Livewire;

use App\Models\Jurnal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email;
    public $password;
    public function logout()
    {
        //dd(Auth::user());
        $user = Auth::user();
        $date = now()->toDateString();

        $jurnal = Jurnal::where('user_id', $user->id)
            ->where('date', $date)
            ->first();

        if ($jurnal) {
            $end_time = now()->toTimeString();
            $start_time = $jurnal->start_time;

            $time_difference = round((strtotime($end_time) - strtotime($start_time)) / 3600, 2);

            $jurnal->update([
                'end_time' => $end_time,
                'time' => $time_difference,
            ]);
        }

        Auth::logout();
        session()->flash('success', 'Siz tizimdan muvaffaqiyatli chiqdingiz!');
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.login-component')->layout('components.Layout.login');
    }
    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = Auth::user();
            $hodim_id = $user->hodim ? $user->hodim->id : null;

            if (!$hodim_id) {
                session()->flash('error', 'Hodim topilmadi!');
                return back();
            }

            $date = now()->toDateString();

            $existingJurnal = Jurnal::where('user_id', $user->id)
                ->where('date', $date)
                ->first();

            if ($existingJurnal) {
                session()->flash('success', 'Siz tizimga muvaffaqiyatli kirdingiz!');
                return redirect('/home');
            }

            $start_time = now()->toTimeString();

            Jurnal::create([
                'hodim_id' => $hodim_id,
                'user_id' => $user->id,
                'date' => $date,
                'start_time' => $start_time,
                'end_time' => null,
                'time' => 0,
            ]);

            session()->flash('success', 'Siz tizimga muvaffaqiyatli kirdingiz! Jurnal saqlandi.');
            return redirect('/home');
        } else {
            session()->flash('error', 'Foydalanuvchi topilmadi!');
            return back();
        }
    }


    public function messages()
    {
        return [
            'email.required' => 'Email manzilni kiritishingiz shart.',
            'email.email' => 'Email manzil noto‘g‘ri formatda.',
            'password.required' => 'Parolni kiritishingiz shart.',
            'password.min' => 'Parol kamida 6 ta belgidan iborat bo‘lishi kerak.',
        ];
    }
}
