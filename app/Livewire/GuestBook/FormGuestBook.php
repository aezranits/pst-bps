<?php

namespace App\Livewire\GuestBook;

use App\Enum\StatusRequestEnum;
use App\Mail\MailableName;
use App\Models\GuestBook;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Request;
use App\Repositories\Interface\GuestbookRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormGuestBook extends Component
{
    use WithFileUploads;

    public $nama_lengkap;
    public $jenis_kelamin;
    public $usia;
    public $pekerjaan; 
    public $jurusan;
    public $asal_universitas;
    public $asal;
    public $asal_universitas_lembaga;
    public $organisasi_nama_perusahaan_kantor;
    public $no_hp;
    public $email;
    public $provinsi_id;
    public $kota_id;
    public $alamat;
    public $tujuan_kunjungan = [];
    public $tujuan_kunjungan_lainnya;
    public $bukti_identitas_diri_path;
    public $dokumen_permintaan_informasi_publik_path;

    protected $rules = [
        'nama_lengkap' => 'required|string|max:255',
        'jenis_kelamin' => 'required|string',
        'usia' => 'required|numeric|min:1|max:150',
        'pekerjaan' => 'required|string',
        'jurusan' => 'nullable|required_if:pekerjaan,mahasiswa|string|max:255',
        'asal_universitas' => 'nullable|required_if:pekerjaan,mahasiswa|string|max:255',
        'asal_universitas_lembaga' => 'nullable|required_if:pekerjaan,peneliti|string|max:255',
        'asal' => 'nullable|required_if:pekerjaan,dinas/instansi/opd|string|max:255',
        'organisasi_nama_perusahaan_kantor' => 'nullable|required_if:pekerjaan,umum|string|max:255',
        'no_hp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
        'email' => 'required|email|max:255',
        'alamat' => 'required|string|max:500',
        'kota_id' => 'required',
        'provinsi_id' => 'required',
        'tujuan_kunjungan' => 'required|array|min:1',
        'tujuan_kunjungan_lainnya' => 'nullable|string',
        'bukti_identitas_diri_path' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', 
        'dokumen_permintaan_informasi_publik_path' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ];

    protected function rules()
    {
        $rules = $this->rules;

        if (in_array('lainnya', $this->tujuan_kunjungan)) {
            $rules['tujuan_kunjungan_lainnya'] = 'required|string|max:255';
        }

        return $rules;
    }

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
            'kota_id.required' => 'Kota wajib diisi.',
            'provinsi_id.required' => 'Provinsi wajib diisi.',
            'tujuan_kunjungan.required' => 'Tujuan kunjungan wajib diisi.',
            'tujuan_kunjungan.array' => 'Tujuan kunjungan harus berupa array.',
            'tujuan_kunjungan.min' => 'Minimal pilih satu tujuan kunjungan.',
            'tujuan_kunjungan_lainnya.string' => 'Tujuan kunjungan lainnya harus berupa teks.',
            'tujuan_kunjungan_lainnya.required' => 'Tujuan kunjungan lainnya wajib diisi jika terdapat tujuan lainnya.',

            // Custom messages for new fields
            'bukti_identitas_diri_path.required' => 'Bukti Identitas Diri wajib diunggah.',
            'bukti_identitas_diri_path.file' => 'Bukti Identitas Diri harus berupa file.',
            'bukti_identitas_diri_path.mimes' => 'Bukti Identitas Diri harus berupa file dengan format jpg, jpeg, png, atau pdf.',
            'bukti_identitas_diri_path.max' => 'Ukuran file Bukti Identitas Diri maksimal 2MB.',

            'dokumen_permintaan_informasi_publik_path.required' => 'Dokumen wajib diunggah.',
            'dokumen_permintaan_informasi_publik_path.file' => 'Dokumen harus berupa file.',
            'dokumen_permintaan_informasi_publik_path.mimes' => 'Dokumen harus berupa file dengan format jpg, jpeg, png, atau pdf.',
            'dokumen_permintaan_informasi_publik_path.max' => 'Ukuran Dokumen maksimal 2MB.',
        ];
    }

    public function updatedProvinceId(){
        $this->kota_id = null;
    }
        
    #[Computed()]
    public function provinces()
    {
        return Province::all();
    }
     
    #[Computed()]
    public function regencies()
    {
        return Regency::where('provinsi_id', $this->provinsi_id)->get();
    }
         
    public function sendEmailFeedback($email, $subject, $name)
    {
        Mail::to($email)->send(new MailableName($subject, $name));
    }

    public function submit()
    {
            Log::info(request());
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

            if ($validatedData['bukti_identitas_diri_path']) {
                $validatedData['bukti_identitas_diri_path'] = $validatedData['bukti_identitas_diri_path']->store('bukti-identitas', 'public');
            }
            if ($validatedData['dokumen_permintaan_informasi_publik_path']) {
                $validatedData['dokumen_permintaan_informasi_publik_path'] = $validatedData['dokumen_permintaan_informasi_publik_path']->store('dokumen-formulir/dokumen-permintaan-informasi-publik', 'public');
            }

            GuestBook::create($validatedData);
            session()->flash('message', 'Guestbook entry created successfully.');
            Log::info("Sukses membuat guestbook");

            // Send email
            // $emailGuest = $validatedData['email'];
            // $nameGuest = $validatedData['nama_lengkap'];
            // $subjectGuest = 'Konfirmasi penilaian Hasil layanan PST BPS Kota Bukittinggi';

            // $this->sendEmailFeedback($emailGuest, $subjectGuest, $nameGuest);
            // Log::info("Sukses mengirim email");
            
            $this->reset();
            Log::info("Sukses reset inputan");
            $this->dispatch('open-modal');
            Log::info("Sukses membuka modal");

    }
    public function rendered(): void
    {
        $this->dispatch('ParentComponentValidated', $this->getErrorBag()->messages());
    }
    public function render()
    {
        return view('livewire.guest-book.form-guest-book');
    }
}
