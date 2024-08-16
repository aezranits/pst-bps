<?php

namespace App\Livewire\GuestBook;

use App\Enum\StatusRequestEnum;
use App\Mail\MailableName;
use App\Models\GuestBook;
use App\Models\Request;
use App\Repositories\Interface\GuestbookRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class FormGuestBook extends Component
{   
    public $nama_lengkap;
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
        'nama_lengkap' => 'required|string|max:255',
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

    protected function messages()
    {
        return [
            'nama_lengkap.required' => 'Nama depan wajib diisi.',
            'nama_lengkap.string' => 'Nama depan harus berupa teks.',
            'nama_lengkap.max' => 'Nama depan maksimal 255 karakter.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.string' => 'Jenis kelamin harus berupa teks.',
            'usia.required' => 'Usia wajib diisi.',
            'usia.numeric' => 'Usia harus berupa angka.',
            'usia.min' => 'Usia minimal 1 tahun.',
            'usia.max' => 'Usia maksimal 150 tahun.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'pekerjaan.string' => 'Pekerjaan harus berupa teks.',
            'jurusan.required_if' => 'Jurusan wajib diisi jika pekerjaan adalah Mahasiswa.',
            'jurusan.string' => 'Jurusan harus berupa teks.',
            'jurusan.max' => 'Jurusan maksimal 255 karakter.',
            'asal_universitas.required_if' => 'Asal universitas wajib diisi jika pekerjaan adalah Mahasiswa.',
            'asal_universitas.string' => 'Asal universitas harus berupa teks.',
            'asal_universitas.max' => 'Asal universitas maksimal 255 karakter.',
            'asal_universitas_lembaga.required_if' => 'Asal universitas/lembaga wajib diisi jika pekerjaan adalah Peneliti.',
            'asal_universitas_lembaga.string' => 'Asal universitas/lembaga harus berupa teks.',
            'asal_universitas_lembaga.max' => 'Asal universitas/lembaga maksimal 255 karakter.',
            'asal.required_if' => 'Asal wajib diisi jika pekerjaan adalah Dinas/Instansi/OPD.',
            'asal.string' => 'Asal harus berupa teks.',
            'asal.max' => 'Asal maksimal 255 karakter.',
            'organisasi_nama_perusahaan_kantor.required_if' => 'Nama perusahaan/kantor wajib diisi jika pekerjaan adalah Umum.',
            'organisasi_nama_perusahaan_kantor.string' => 'Nama perusahaan/kantor harus berupa teks.',
            'organisasi_nama_perusahaan_kantor.max' => 'Nama perusahaan/kantor maksimal 255 karakter.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Nomor HP harus berupa angka.',
            'no_hp.min' => 'Nomor HP minimal 10 karakter.',
            'no_hp.max' => 'Nomor HP maksimal 15 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 500 karakter.',
            'kota.required' => 'Kota wajib diisi.',
            'kota.string' => 'Kota harus berupa teks.',
            'kota.max' => 'Kota maksimal 255 karakter.',
            'provinsi.required' => 'Provinsi wajib diisi.',
            'provinsi.string' => 'Provinsi harus berupa teks.',
            'provinsi.max' => 'Provinsi maksimal 255 karakter.',
            'tujuan_kunjungan.required' => 'Tujuan kunjungan wajib diisi.',
            'tujuan_kunjungan.array' => 'Tujuan kunjungan harus berupa array.',
            'tujuan_kunjungan.min' => 'Minimal pilih satu tujuan kunjungan.',
            'tujuan_kunjungan_lainnya.string' => 'Tujuan kunjungan lainnya harus berupa teks.',
            'tujuan_kunjungan_lainnya.max' => 'Tujuan kunjungan lainnya maksimal 255 karakter.',
        ];
    }

    public function sendEmailFeedback($email, $subject, $name){
        Mail::to($email)->send(new MailableName($subject, $name));
    }

    public function submit()
    {
            $validatedData = $this->validate();

            if (!in_array('lainnya', $validatedData['tujuan_kunjungan'])) {
                $validatedData['tujuan_kunjungan_lainnya'] = null;
            }
    
            switch ($validatedData['pekerjaan']) {
                case 'mahasiswa':
                    $validatedData['asal'] = null;
                    $validatedData['asal_universitas_lembaga'] = null;
                    $validatedData['organisasi_nama_perusahaan_kantor'] = null;
                    break;
                case 'dinas/instansi/opd':
                    $validatedData['jurusan'] = null;
                    $validatedData['asal_universitas'] = null;
                    $validatedData['asal_universitas_lembaga'] = null;
                    $validatedData['organisasi_nama_perusahaan_kantor'] = null;
                    break;
                case 'peneliti':
                    $validatedData['jurusan'] = null;
                    $validatedData['asal_universitas'] = null;
                    $validatedData['asal'] = null;
                    $validatedData['organisasi_nama_perusahaan_kantor'] = null;
                    break;
                case 'umum':
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
            
            session()->flash('message', 'Guestbook entry created successfully.');
            $emailGuest = $validatedData['email'];
            $nameGuest = $validatedData['nama_lengkap'];
            $subjectGuest = "Konfirmasi penilaian Hasil layanan PST BPS Kota Bukittinggi";

            $this->sendEmailFeedback($emailGuest, $subjectGuest, $nameGuest);   
            $this->reset();
            $this->dispatch('open-modal');
    }
    
    public function render()
    {
        return view('livewire.guest-book.form-guest-book');
    }
}
