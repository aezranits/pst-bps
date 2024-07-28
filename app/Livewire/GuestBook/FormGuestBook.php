<?php

namespace App\Livewire\GuestBook;

use App\Models\GuestBook;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class FormGuestBook extends Component
{   
    public $first_name;
    public $last_name;
    public $jenis_kelamin;
    public $usia;
    public $pekerjaan; // Make sure this property is defined
    public $jurusan;
    public $asal_universitas;
    public $asal;
    public $asal_universitas_lembaga;
    public $organisasi_nama_perusahaan_kantor;
    public $no_hp;
    public $email;
    public $alamat;
    public $kota;
    public $provinsi;
    public $tujuan_kunjungan = [];
    public $tujuan_kunjungan_lainnya;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'jenis_kelamin' => 'required|string',
        'usia' => 'required|numeric|min:1|max:150',
        'pekerjaan' => 'required|string',
        'jurusan' => 'nullable|required_if:pekerjaan,Mahasiswa|string|max:255',
        'asal_universitas' => 'nullable|required_if:pekerjaan,Mahasiswa|string|max:255',
        'asal_universitas_lembaga' => 'nullable|required_if:pekerjaan,Peneliti|string|max:255',
        'asal' => 'nullable|required_if:pekerjaan,Dinas/Instansi/OPD|string|max:255',
        'organisasi_nama_perusahaan_kantor' => 'nullable|required_if:pekerjaan,Umum|string|max:255',
        'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
        'email' => 'required|email|max:255',
        'alamat' => 'required|string|max:500',
        'kota' => 'required|string|max:255',
        'provinsi' => 'required|string|max:255',
        'tujuan_kunjungan' => 'required|array|min:1',
        'tujuan_kunjungan_lainnya' => 'nullable|string|max:255',
    ];

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    public function submit()
    {
            $validatedData = $this->validate();
            $validatedData['nama_lengkap'] = $validatedData['first_name'] . ' ' . $validatedData['last_name'];

            if (!in_array('lainnya', $validatedData['tujuan_kunjungan'])) {
                $validatedData['tujuan_kunjungan_lainnya'] = null;
            }
    
            switch ($validatedData['pekerjaan']) {
                case 'Mahasiswa':
                    $validatedData['asal'] = null;
                    $validatedData['asal_universitas_lembaga'] = null;
                    $validatedData['organisasi_nama_perusahaan_kantor'] = null;
                    break;
                case 'Dinas/Instansi/OPD':
                    $validatedData['jurusan'] = null;
                    $validatedData['asal_universitas'] = null;
                    $validatedData['asal_universitas_lembaga'] = null;
                    $validatedData['organisasi_nama_perusahaan_kantor'] = null;
                    break;
                case 'Peneliti':
                    $validatedData['jurusan'] = null;
                    $validatedData['asal_universitas'] = null;
                    $validatedData['asal'] = null;
                    $validatedData['organisasi_nama_perusahaan_kantor'] = null;
                    break;
                case 'Umum':
                    $validatedData['jurusan'] = null;
                    $validatedData['asal_universitas'] = null;
                    $validatedData['asal'] = null;
                    $validatedData['asal_universitas_lembaga'] = null;
                    break;
                default:
                    $validatedData['jurusan'] = null;
                    $validatedData['asal_universitas'] = null;
                    $validatedData['asal'] = null;
                    $validatedData['asal_universitas_lembaga'] = null;
                    $validatedData['organisasi_nama_perusahaan_kantor'] = null;
                    break;
            }

            $validatedData['asal_kota'] = $validatedData['alamat'] . ', ' . $validatedData['kota']. ', ' . $validatedData['provinsi'];
            GuestBook::create($validatedData);
            $this->reset();
            $this->dispatch('open-modal');
    }
    
    public function render()
    {
        return view('livewire.guest-book.form-guest-book');
    }
}
