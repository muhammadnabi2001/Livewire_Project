<?php

namespace App\Livewire;

use App\Models\Jurnal;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class JurnalComponent extends Component
{
    public $remday;
    public $remuser;
    public $start_time;
    public $end_time;
    public $name;
    public $users;
    public $days;
    public $now;
    public $select;
    public $permit = false;
    public function render()
    {
        $this->users = User::orderBy('id', 'desc')->get();
        $daysInMonth = Carbon::parse(now())->daysInMonth;
        $this->days = range(1, $daysInMonth);
        $this->day();
        return view('livewire.jurnal-component');
    }
    public function day()
    {
        //dd($this->select);
        $this->now = Carbon::parse($this->select)->format('F Y');
        $daysInMonth = Carbon::parse($this->now)->daysInMonth;

        $this->days = range(1, $daysInMonth);
    }
    public function checkJurnal($userId, $day)
    {
        $selectedDate = Carbon::parse($this->select);
        $formattedDate = $selectedDate->format('Y-m') . '-' . ($day < 10 ? '0' . $day : $day);
        $jurnal = Jurnal::where('user_id', $userId)
            ->where('date', $formattedDate)
            ->first();
        return $jurnal;
    }
    public function plus(User $user, $day)
    {
        $this->name = $user->name;
        $this->remuser = $user;
        $this->remday = $day;

        $this->permit = true;
    }
    public function store()
    {
        $hodim_id = $this->remuser->hodim ? $this->remuser->hodim->id : null;

        if (!$hodim_id) {
            session()->flash('error', 'Hodim topilmadi!');
            return back();
        }

        $selectedDate = Carbon::parse($this->select);
        $formattedDate = $selectedDate->format('Y-m') . '-' . ($this->remday < 10 ? '0' . $this->remday : $this->remday);

        $start_time = $this->start_time ?: null;
        $end_time = $this->end_time ?: null;

        if ($start_time && $end_time) {
            $time_difference = round((strtotime($end_time) - strtotime($start_time)) / 3600, 2);
        } else {
            $time_difference = 0;
        }

        if (!$start_time) {
            $existing_jurnal = Jurnal::where('user_id', $this->remuser->id)
                ->where('date', $formattedDate)
                ->first();

            if ($existing_jurnal && $existing_jurnal->start_time) {
                $start_time = $existing_jurnal->start_time;
                $time_difference = round((strtotime($end_time) - strtotime($existing_jurnal->start_time)) / 3600, 2);
            }
        }

        Jurnal::updateOrCreate(
            [
                'hodim_id' => $hodim_id,
                'user_id' => $this->remuser->id,
                'date' => $formattedDate,
            ],
            [
                'start_time' => $start_time,
                'end_time' => $end_time,
                'time' => $time_difference,
            ]
        );

        $this->reset();
        $this->permit = false;
    }

    public function back()
    {
        $this->permit = false;
    }
}
