<?php

namespace App\Livewire;

use App\Models\Hodim;
use App\Models\Jurnal;
use App\Models\Salary;
use App\Models\UserOrder;
use Carbon\Carbon;
use Livewire\Component;

class GiveSalaryComponent extends Component
{
    public $users;
    public $now;
    public $select;
    public $summa;
    public function mount()
    {
        $this->select = now()->format('Y-m-d');
    }
    public function render()
    {
        $this->users = Hodim::orderBy('id', 'desc')->get();
        $this->now = now();
        $this->day();
        return view('livewire.give-salary-component');
    }
    public function day()
    {
        //dd($this->select);
        $this->now = Carbon::parse($this->select)->format('F Y');
    }
    public function salarycalculate(Hodim $hodim)
    {

        if (!$hodim) {
            return back();
        }
        $soatiga = $hodim->oylik_miqdor / $hodim->oylik_time;
        $selectedTime = $this->select;
        $year = date('Y', strtotime($selectedTime));
        $month = date('m', strtotime($selectedTime));
        $jurnal = Jurnal::where('hodim_id', $hodim->id)->whereYear('date', $year)->whereMonth('date', $month)->get();

        if ($jurnal->isEmpty()) {
            return [
                'total_worked_hours' => 0,
                'hours_deficit' => $hodim->oylik_time,
                'salary' => 0,
                'message' => 'Jurnalda ma\'lumot topilmadi'
            ];
        }
        $totalWorkedHours = 0;

        foreach ($jurnal as $entry) {
            $totalWorkedHours += $entry->time;
        }
        $sub = $hodim->oylik_time - $totalWorkedHours;

        if ($sub > 0) {
            $jamioylik = $hodim->oylik_miqdor - $soatiga * $sub;
        } else {
            $jamioylik = $hodim->oylik_miqdor;
        }
        return [
            'total_worked_hours' => $totalWorkedHours,
            'hours_deficit' => max($sub, 0),
            'salary' => $jamioylik
        ];
    }
    public function give(Hodim $hodim)
    {
        $ishlagan = $this->salarycalculate($hodim);
        $selectedTime = $this->select;
        $year = date('Y', strtotime($selectedTime));
        $month = date('m', strtotime($selectedTime));
        $count = UserOrder::where('id', $hodim->id)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();
        $check=Jurnal::where('id',$hodim->id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
        if($check->isEmpty())
        {
            return redirect()->back()->with('success',"Hodim bu oyda ishlamagan");
        }
    
        if ($hodim->role == 'afitsant') {
            $ishlagan['salary'] += $count * $hodim->bonus;
        } elseif ($hodim->oylik_type == 'mixed' && $hodim->oylik_time < $ishlagan['total_worked_hours']) {
            $soatiga = $hodim->oylik_miqdor / $hodim->oylik_time;
            $farq = $ishlagan['total_worked_hours'] - $hodim->oylik_time;
            $ishlagan['salary'] += $farq * $soatiga * $hodim->bonus;
        }
        $this->validate([
            'summa' => 'required|numeric|min:0|max:' . $ishlagan['salary'],
        ], $this->messages());
        $qolgan = $ishlagan['salary'] 
        - Salary::where('hodim_id', $hodim->id)
            ->whereMonth('date', $month) 
            ->whereYear('date', $year)
            ->sum('berildi');
        if($qolgan>=$this->summa)
        {

            Salary::create([
                'hodim_id' => $hodim->id,
                'type' => $hodim->oylik_type,
                'date' => Carbon::parse(now())->format('Y-m-d'),
                'oylik' => $this->summa,
                'berildi' => $this->summa,
                'qolgan'=>$qolgan
            ]);
        }
        else{
            return redirect()->back()->with('success',"oylik miqdor notug'ri berilgan");
        }
        session()->flash('success', 'Oylik muvaffaqiyatli berildi!');

        // dd($ishlagan['total_worked_hours']);
    }
    public function count(Hodim $hodim)
    {
        $selectedTime = $this->select;
        $year = date('Y', strtotime($selectedTime));
        $month = date('m', strtotime($selectedTime));
        $berilgan = Salary::where('hodim_id', $hodim->id)->whereMonth('date', $month)->whereYear('date', $year)->sum('berildi');
        $ishlagan = $this->salarycalculate($hodim);
        $count = UserOrder::where('id', $hodim->id)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();
        if ($hodim->user->role == 'afitsant') {
            $ishlagan['salary'] += $count * $hodim->bonus;
        } elseif ($hodim->oylik_type == 'mixed' && $hodim->oylik_time <=$ishlagan['total_worked_hours']) {
            $soatiga = $hodim->oylik_miqdor / $hodim->oylik_time;
            $farq = $ishlagan['total_worked_hours'] - $hodim->oylik_time;
            $ishlagan['salary'] += $farq * $soatiga * $hodim->bonus;
        }


        $qolgan=$ishlagan['salary']-$berilgan;
        return [
            'berilgan'=>$berilgan,
            'qolgan'=>$qolgan
        ];
    }
    public function bonus(Hodim $hodim)
    {
        $ishlagan = $this->salarycalculate($hodim);
        $soatiga = $hodim->oylik_miqdor / $hodim->oylik_time;
        $selectedTime = $this->select;
        $year = date('Y', strtotime($selectedTime));
        $month = date('m', strtotime($selectedTime));
        $count = UserOrder::where('id', $hodim->id)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();
        if ($hodim->user->role == 'afitsant') {
            return [
                'bonus'=>  $count * $hodim->bonus
            ];
        }
        if($hodim->oylik_type=='fixed')
        {
            return ['bonus'=>0];
        }
        elseif($hodim->oylik_type == 'mixed' && $hodim->oylik_time <=$ishlagan['total_worked_hours'])
        {
            
                $soatiga = $hodim->oylik_miqdor / $hodim->oylik_time;
                $farq = $ishlagan['total_worked_hours'] - $hodim->oylik_time;
                return [
                    'bonus'=>$farq * $soatiga * $hodim->bonus
                ];
        }
        else{
            return ['bonus'=>0];
        }
    }
    public function messages()
    {
        return [
            'summa.required' => 'Summa qiymati kiritilmagan',
            'summa.min' => "summa miqdori 0 sumdan baland bulishi kerak",
            'summa.max' => 'summa miqdori ishchi ishlaganidan ko\'p bulmasligi kerak'
        ];
    }
}
