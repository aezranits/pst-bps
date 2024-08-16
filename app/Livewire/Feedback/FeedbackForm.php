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

    public $nama_lengkap;
    public $petugas_pst;
    public $front_office;
    public $kepuasan_petugas_pst;
    public $kepuasan_petugas_front_office;
    public $kepuasan_sarana_prasarana;
    public $kritik_saran;

    protected $rules = [
        'nama_lengkap' => 'string|required',
        'petugas_pst' => 'required',
        'front_office' => 'required',
        'kepuasan_petugas_pst' => 'required|integer|between:1,5',
        'kepuasan_petugas_front_office' => 'required|integer|between:1,5',
        'kepuasan_sarana_prasarana' => 'required|integer|between:1,5',
        'kritik_saran' => 'string',
    ];

    protected function messages()
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.string' => 'Nama lengkap harus berupa teks.',
            'petugas_pst.required' => 'Petugas PST wajib dipilih.',
            'front_office.required' => 'Front Office wajib dipilih.',
            'kepuasan_petugas_pst.required' => 'Kepuasan terhadap petugas PST wajib diisi.',
            'kepuasan_petugas_pst.integer' => 'Kepuasan terhadap petugas PST harus berupa angka.',
            'kepuasan_petugas_pst.between' => 'Kepuasan terhadap petugas PST harus antara 1 hingga 5.',
            'kepuasan_petugas_front_office.required' => 'Kepuasan terhadap petugas Front Office wajib diisi.',
            'kepuasan_petugas_front_office.integer' => 'Kepuasan terhadap petugas Front Office harus berupa angka.',
            'kepuasan_petugas_front_office.between' => 'Kepuasan terhadap petugas Front Office harus antara 1 hingga 5.',
            'kepuasan_sarana_prasarana.required' => 'Kepuasan terhadap sarana dan prasarana wajib diisi.',
            'kepuasan_sarana_prasarana.integer' => 'Kepuasan terhadap sarana dan prasarana harus berupa angka.',
            'kepuasan_sarana_prasarana.between' => 'Kepuasan terhadap sarana dan prasarana harus antara 1 hingga 5.',
            'kritik_saran.string' => 'Kritik dan saran harus berupa teks.',
        ];
    }

    public function mount()
    {
        $this->petugasPst = User::role('pst')->get();
        $this->frontOffice = User::role('front-office')->get();
    }

    public function submit()
    {
        $validateData = $this->validate();
        Feedback::create($validateData);
        $this->reset();
        $this->dispatch('open-modal');
    }

    public function getListeners()
    {
        return [
            'setPetugasPst' => 'updatePetugasPst',
            'setFrontOffice' => 'updateFrontOffice',
        ];
    }

    public function updatePetugasPst($value)
    {
        $this->petugas_pst = $value;
    }

    public function updateFrontOffice($value)
    {
        $this->front_office = $value;
    }

    public function render()
    {
        return view('livewire.feedback.feedback-form');
    }
}
