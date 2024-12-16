<?php

namespace App\Livewire;

use App\Models\Hodim;
use App\Models\Jurnal;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class FixedSalaryComponent extends Component
{
    public $users;
    public $now;
    public $select;
    public function mount()
{
    // `select` o'zgaruvchisini hozirgi sanaga tenglashtirish
    $this->select = now()->format('Y-m-d'); // Hozirgi sana YYYY-MM-DD formatida
}
    public function render()
    {
        $this->users = Hodim::where('oylik_type', 'fixed')->get();
        $this->now = now();
        $this->day();
        return view('livewire.fixed-salary-component');
    }
    public function day()
    {
        //dd($this->select);
        $this->now = Carbon::parse($this->select)->format('F Y');
    }
    public function salarycalculate($id)
    {
       // dd($id);
        $hodim = Hodim::where('id', $id)->first();
        if (!$hodim) {
            return back();
        }
        //dd($id);
        $soatiga = $hodim->oylik_miqdor / $hodim->oylik_time;
        $selectedTime = $this->select;
        $year = date('Y', strtotime($selectedTime));
        $month = date('m', strtotime($selectedTime));
        //dd($this->select);
        $jurnal = Jurnal::where('hodim_id', $hodim->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();
            if ($jurnal->isEmpty()) {
                return back()->with('error', 'Ma\'lumotlar topilmadi');
            }
           //dd($jurnal);

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
        return $jamioylik;
        //dd($jamioylik);
    }
}
