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
    public $kurish=false;
    public $users;
    public $extension;
    public $editextension;
    public $filename;
    public $editfilename;
    public $bulims;
    public $check;
    public $allow = false;
    public $user_id = '';
    public $edituser_id;
    public $bulim_id = '';
    public $editbulim_id;
    public $oylik_type = '';
    public $editoylik_type;
    public $oylik_miqdor;
    public $editoylik_miqdor;
    public $bonus;
    public $editbonus;
    public $start_time;
    public $editstart_time;
    public $editend_time;
    public $end_time;
    public $img;
    public $editimg;
    public $detail;
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'bulim_id' => 'required|exists:bulims,id',
        'oylik_type' => 'required|in:fixed,mixed',
        'img' => 'required|mimes:jpg,jpeg,png,xlsx,docx|max:1024',
        'oylik_miqdor' => 'required|numeric|min:0',
        'bonus' => 'nullable|numeric|min:0',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',

    ];
    public function update($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        $this->users = User::all();
        $this->bulims = Bulim::all();
        $hodimlar = Hodim::orderBy('id', 'desc')->paginate(10);
        return view('livewire.hodim-component', compact('hodimlar'));
    }
    public function Create()
    {
        $this->check = true;
    }
    public function Back()
    {
        $this->check = false;
    }
    public function nazad()
    {
        //dd(1233);
        $this->allow = false;

    }
    public function store()
    {

        $this->validate();
        $time_difference = round((strtotime($this->end_time) - strtotime($this->start_time)) / 3600, 2);

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
                'kunlik_time' => $time_difference,
                'oylik_time' => $time_difference * 5 * 4,
            ]);
        }
        $this->reset();
    }
    public function delete(Hodim $hodim)
    {
        if ($hodim) {
            $hodim->delete();
        }
    }
    public function change(Hodim $hodim)
    {
        //dd($id);
        $this->allow = $hodim->id;
        $this->edituser_id = $hodim->user_id;
        $this->editoylik_type = $hodim->oylik_type;
        $this->editbulim_id = $hodim->bulim_id;
        $this->editoylik_miqdor = $hodim->oylik_miqdor;
        $this->editstart_time = $hodim->start_time;
        $this->editend_time = $hodim->end_time;
        $this->editbonus = $hodim->bonus;
    }
    public function edit()
    {
        //    dd($this->edituser_id);
        $this->validate([
            'edituser_id' => 'required|exists:users,id',
            'editbulim_id' => 'required|exists:bulims,id',
            'editoylik_type' => 'required|in:fixed,mixed',
            'editimg' => 'nullable|mimes:jpg,jpeg,png,xlsx,docx|max:1024',
            'editoylik_miqdor' => 'required|numeric|min:0',
            'editbonus' => 'nullable|numeric|min:0',
            'editstart_time' => 'nullable',
            'editend_time' => 'nullable|after:editstart_time',
        ]);
        //dd(123);
        $hodim = Hodim::findOrFail($this->allow);

        if ($this->editimg) {
            $this->editextension = $this->editimg->getClientOriginalExtension();
            $this->editfilename = date("Y-m-d") . '_' . time() . '.' . $this->editextension;

            $p = $this->editimg->storeAs('img_uploaded', $this->editfilename, 'public');
        } else {
            $p = $hodim->img;
        }
        $time_difference = round((strtotime($this->editend_time) - strtotime($this->editstart_time)) / 3600, 2);

        $hodim->update([
            'user_id' => $this->edituser_id,
            'bulim_id' => $this->editbulim_id,
            'img' => $p,
            'oylik_type' => $this->editoylik_type,
            'oylik_miqdor' => $this->editoylik_miqdor,
            'bonus' => $this->editbonus,
            'start_time' => $this->editstart_time,
            'end_time' => $this->editend_time,
            'kunlik_time' => $time_difference,
            'oylik_time' => $time_difference * 5 * 4,
        ]);
        $this->reset();
        $this->allow = false;
    }
    public function observe(Hodim $hodim)
    {
       // dd($hodim);
       $this->detail=$hodim;
       $this->kurish=true;
    }
    public function restore()
    {
        $this->kurish=false;
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
            'start_time.required' => 'Sana tanlanmagan',
            'end_time.required' => 'Sana tanlanmagan',
            'edituser_id.required' => 'Foydalanuvchi tanlanishi kerak.',
            'edituser_id.exists' => 'Tanlangan foydalanuvchi mavjud emas.',
            'editbulim_id.required' => 'Bo‘lim tanlanishi kerak.',
            'editbulim_id.exists' => 'Tanlangan bo‘lim mavjud emas.',
            'editoylik_type.required' => 'Oylik turi tanlanishi kerak.',
            'editoylik_type.in' => 'Oylik turi faqat "fixed" yoki "mixed" bo‘lishi mumkin.',
            'editimg.mimes' => 'Rasm faqat jpg, jpeg, png yoki docx/xlsx formatida bo‘lishi mumkin.',
            'editimg.max' => 'Rasmning hajmi maksimal 1MB bo‘lishi kerak.',
            'editoylik_miqdor.required' => 'Oylik miqdori kiritilishi kerak.',
            'editoylik_miqdor.numeric' => 'Oylik miqdori raqam bo‘lishi kerak.',
            'editoylik_miqdor.min' => 'Oylik miqdori 0 dan katta bo‘lishi kerak.',
            'editbonus.numeric' => 'Bonus raqam bo‘lishi kerak.',
            'editbonus.min' => 'Bonus 0 dan katta bo‘lishi kerak.',
            'editstart_time.nullable' => 'Boshlanish vaqti kiritilishi shart emas.',
            'editend_time.nullable' => 'Tugash vaqti kiritilishi shart emas.',
            'editend_time.after' => 'Tugash vaqti boshlanish vaqtidan keyin bo‘lishi kerak.',
        ];
    }
}
