<?php

namespace App\Livewire;

use App\Jobs\SendMessage;
use App\Mail\SendCode;
use App\Mail\SendEmail;
use App\Models\User;
use App\Models\Verfication;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ForgotpasswordComponent extends Component
{
    public $permittion = false;
    public $email;
    public $code;
    public $secret;
    public $check;
    public function render()
    {
        return view('livewire.forgotpassword-component')->layout('components.Layout.login');
    }
    public function sending()
    {
        $this->code = rand(1000, 9999);

        if (empty($this->email)) {
            session()->flash('error', 'Email manzili kiritilmagan!');
            return;
        }
        $this->check = User::where('email', $this->email)->first();

        if (!$this->check) {
            session()->flash('error', 'Foydalanuvchi topilmadi!');
            return;
        }
        else{
            Verfication::create([
                'user_id'=>$this->check->id,
                'code'=>$this->code,
            ]);
        }

        try {
            SendMessage::dispatch($this->email, $this->code);
            //Mail::to($this->email)->send(new SendCode($this->code));

            $this->permittion = true;

            session()->flash('success', 'Kod yuborildi!');
        } catch (\Exception $e) {
            session()->flash('error', 'Email yuborishda xatolik: ' . $e->getMessage());
        }
    }
    public function verification()
    {
        //dd($this->secret);
        $user=Verfication::where('user_id',$this->check->id)->where('code',$this->secret)->first();
        //dd($user);
        if ($user) {
            return redirect('/'); 
        } else {
            session()->flash('error', 'Xatolik! Kod noto\'g\'ri.');
            return back();
        }
    }
}
