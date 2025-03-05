<?php

namespace App\Livewire;

use App\Models\Hodim;
use App\Models\Jurnal;
use App\Models\UserOrder;
use Carbon\Carbon;
use Livewire\Component;

class KpiSalaryComponent extends Component
{
    public $users;
    public $now;
    public $select;
    public function mount()
    {
        $this->select = now()->format('Y-m-d');
    }
    public function render()
    {
        $this->users = Hodim::where('oylik_type', 'mixed')->get();
        $this->now = now();
        $this->day();
        return view('livewire.kpi-salary-component');
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
        $count = UserOrder::where('id', $hodim->id)
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->count();
        $jurnal = Jurnal::where('hodim_id', $hodim->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

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

        if ($sub > 0 && !$hodim->user->role !='afitsant') {
            $jamioylik = $hodim->oylik_miqdor - abs($sub) * $soatiga;
        }
        elseif($hodim->user->role !='afitsant'){
            $jamioylik = $hodim->oylik_miqdor + abs($sub) * $soatiga * $hodim->bonus;
        }
        if($hodim->user->role=='afitsant')
        {
            $jamioylik = $totalWorkedHours*$soatiga+$count * $hodim->bonus;
        }
        return [
            'total_worked_hours' => $totalWorkedHours,
            'hours_deficit' => max($sub, 0),
            'salary' => $jamioylik
        ];
    }
}
