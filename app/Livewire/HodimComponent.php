<?php

namespace App\Livewire;

use App\Models\Bulim;
use App\Models\Hodim;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class HodimComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $users;
    public $extension;
    public $filename;
    public $bulims;
    public $check;
    public $allow;
    public $user_id='';
    public $bulim_id='';
    public $oylik_type='';
    public $oylik_miqdor;
    public $bonus;
    public $oylik_time;
    public $kunlik_time;
    public $start_time;
    public $end_time;
    public $img;
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'bulim_id' => 'required|exists:bulims,id',
        'oylik_type' => 'required|in:fixed,mixed', 
        'img' => 'required|mimes:jpg,jpeg,png,xlsx,docx|max:1024', 
        'oylik_miqdor' => 'required|numeric|min:0',
        'bonus' => 'nullable|numeric|min:0',
        'start_time' => 'nullable',
        'end_time' => 'nullable|after:start_time',
        'kunlik_time' => 'nullable|date_format:H:i',
        'oylik_time' => 'nullable|date_format:H:i',
    ];
    public function update($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        $this->users=User::all();
        $this->bulims=Bulim::all();
        $hodimlar=Hodim::orderBy('id','desc')->paginate(10);
        return view('livewire.hodim-component',compact('hodimlar'));
    }
    public function Create()
    {
        $this->check = true;
    }
    public function Back()
    {
        $this->check = false;
    }
    public function store()
    {
        $this->validate();
        //dd($this->user_id,$this->bulim_id,$this->oylik_type,$this->img,$this->oylik_miqdor,$this->bonus,$this->start_time,$this->end_time,$this->kunlik_time,$this->oylik_time);
        if ($this->img) {
            $this->extension = $this->img->getClientOriginalExtension();
            $this->filename = date("Y-m-d") . '_' . time() . '.' . $this->extension;

            $path = $this->img->storeAs('img_uploaded', $this->filename, 'public');
            Hodim::create([
                'user_id' => $this->user_id,
                'bulim_id' => $this->bulim_id,
                'img' => $path,
                'oylik_type' => $this->oylik_type,
                'oylik_miqdor' => $this->oylik_miqdor,
                'bonus' => $this->bonus,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'kunlik_time' => $this->kunlik_time,
                'oylik_time' => $this->oylik_time,
            ]);
        }
        $this->reset();
    }
    public function messages()
    {
        return [
            'user_id.required' => 'Iltimos, foydalanuvchini tanlang.',
            'user_id.exists' => 'Tanlangan foydalanuvchi mavjud emas.',
            'bulim_id.required' => 'Iltimos, bo\'limni tanlang.',
            'bulim_id.exists' => 'Tanlangan bo\'lim mavjud emas.',
            'oylik_type.required' => 'Oylik turini tanlang.',
            'oylik_type.in' => 'Oylik turi faqat "fixed" yoki "mixed" bo\'lishi kerak.',
            'img.mimes' => 'Faqat jpg, jpeg, png, xlsx yoki docx formatidagi fayllarni yuklashingiz mumkin.',
            'img.max' => 'Fayl hajmi 1MB dan oshmasligi kerak.',
            'img.required' => 'Rasm maydonini to\'ldiring',
            'oylik_miqdor.required' => 'Oylik miqdorini kiriting.',
            'oylik_miqdor.numeric' => 'Oylik miqdori faqat raqam bo\'lishi kerak.',
            'oylik_miqdor.min' => 'Oylik miqdori 0 dan katta bo\'lishi kerak.',
            'bonus.numeric' => 'Bonus faqat raqam bo\'lishi kerak.',
            'bonus.min' => 'Bonus 0 dan kichik bo\'lmasligi kerak.',
            'end_time.after' => 'End time start time\'dan keyin bo\'lishi kerak.',
            'kunlik_time.date_format' => 'Kunlik time soat va daqiqalar formatida bo\'lishi kerak (HH:MM).',
            'oylik_time.date_format' => 'Oylik time soat va daqiqalar formatida bo\'lishi kerak (HH:MM).',
        ];
    
    }
}
