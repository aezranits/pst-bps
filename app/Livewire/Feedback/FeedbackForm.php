<?php

namespace App\Livewire\Feedback;

use App\Models\Feedback;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class FeedbackForm extends Component
{
    public $frontOffice = [];
    public $petugasPst = [];

    public $petugas_pst_id;
    public $front_office_id;
    public $kepuasan_petugas_pst;
    public $kepuasan_petugas_front_office;
    public $kepuasan_sarana_prasarana;
    public $kritik_saran;

    protected $rules = [
        'petugas_pst_id' => 'required',
        'front_office_id' => 'required',
        'kepuasan_petugas_pst' => 'required|integer|between:1,5',
        'kepuasan_petugas_front_office' => 'required|integer|between:1,5',
        'kepuasan_sarana_prasarana' => 'required|integer|between:1,5',
        'kritik_saran' => 'string'
    ];
    
    public function mount()
    {
        $this->petugasPst = User::whereHas('roles', function($query) {
            $query->where('name', 'petugas_pst');
        })->get();
        $this->frontOffice = User::whereHas('roles', function($query) {
            $query->where('name', 'front_office');
        })->get();
    }

    public function submit()
    {
        $validatedData = $this->validate();
        Feedback::create($validatedData);
        $this->reset();
        
    }

    public function render()
    {
        return view('livewire.feedback.feedback-form');
    }
}