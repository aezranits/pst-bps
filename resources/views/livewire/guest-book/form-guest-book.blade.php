<div x-data="{ pekerjaan: '{{ $pekerjaan }}', jenisKelamin: '{{ $jenis_kelamin }}', tujuanLainnya: false }" @pekerjaan-changed.window="pekerjaan = $event.detail; $wire.set('pekerjaan', pekerjaan)"
 @jenis_kelamin-changed.window="jenisKelamin = $event.detail; $wire.set('jenis_kelamin', jenisKelamin)"
 @tujuan_kunjungan-changed.window="tujuanKunjungan = $event.detail;if(tujuanKunjungan.includes('lainnya')) {tujuanLainnya = true;} else {tujuanLainnya = false;}; $wire.set('tujuan_kunjungan', tujuanKunjungan)">
 <div>
  <h2 class="block text-4xl font-bold leading-7 text-grey lg:hidden">Buku Tamu</h2>

  <div
   class="mt-5 space-y-8 border-b lg:mt-0 border-gray-900/10 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">
   <form wire:submit.prevent="submit">
    <!-- Nama Lengkap -->
    <div class="pb-3 sm:pb-6">
     <livewire:components.text-input colorText="text-grey" label="Nama Lengkap" name="nama_lengkap"
      placeholder="Ade Setiawan" wire:model="nama_lengkap" />
    </div>

    <!-- Jenis Kelamin -->
    <livewire:components.radio-button-input colorText="text-grey" name="jenis_kelamin" label="Jenis Kelamin"
     :options="['Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan']" />

    <!-- Umur -->
    <div class="py-3 sm:py-6">
     <livewire:components.text-input colorText="text-grey" type="number" label="Usia" name="usia"
      wire:model="usia" placeholder="25" />
    </div>

    <!-- Pekerjaan -->
    <livewire:components.radio-button-input colorText="text-grey" name="pekerjaan" label="Pekerjaan"
     :options="[
         'mahasiswa' => 'Mahasiswa',
         'dinas/instansi/opd' => 'Dinas/Instansi/OPD',
         'peneliti' => 'Peneliti',
         'umum' => 'Umum',
     ]" />

    <!-- Conditional Inputs -->
    <div x-show="pekerjaan === 'mahasiswa'">
     <div>
      <div class="py-3 sm:py-6">

       <livewire:components.text-input colorText="text-grey" label="Jurusan" name="jurusan" placeholder="Statistika"
        wire:model="jurusan" />
      </div>
      <div class="py-3 sm:py-6">

       <livewire:components.text-input colorText="text-grey" label="Asal Universitas" name="asal_universitas"
        placeholder="Universitas Islam Negeri Sjech M. Djamil Djambek Bukittinggi" wire:model="asal_universitas" />
      </div>
     </div>
    </div>

    <div x-show="pekerjaan === 'dinas/instansi/opd'">
     <div class="py-3 sm:py-6">

      <livewire:components.text-input colorText="text-grey" label="Asal Instansi" name="asal"
       placeholder="Diskominfo Kota Bukittinggi" wire:model="asal" />
     </div>
    </div>

    <div x-show="pekerjaan === 'peneliti'">
     <div class="py-3 sm:py-6">

      <livewire:components.text-input colorText="text-grey" label="Asal Universitas / Lembaga Penelitian"
       name="asal_universitas_lembaga" wire:model="asal_universitas_lembaga" placeholder="The SMERU Research Institute" />
     </div>
    </div>

    <div x-show="pekerjaan === 'umum'">
     <div class="py-3 sm:py-6">

      <livewire:components.text-input colorText="text-grey" label="Organisasi/Nama Perusahaan/Kantor"
       name="organisasi_nama_perusahaan_kantor" wire:model="organisasi_nama_perusahaan_kantor"  placeholder="Komunitas Bantuan Sosial"/>
     </div>
    </div>

    {{-- No HP --}}
    <div class="py-3 sm:py-6">
     <livewire:components.text-input colorText="text-grey" type="tel" label="No HP" name="no_hp"
      wire:model="no_hp" placeholder="081234567890" pattern="[0-9]*" inputmode="numeric" />
    </div>

    <div class="py-3 sm:py-6">
     <livewire:components.text-input colorText="text-grey" label="Email" name="email" placeholder="pstbps@gmail.com"
      type="email" wire:model="email" />
    </div>

    <!-- Pilihan Lainnya (Jika pekerjaan adalah umum, peneliti, dll) -->
    <div class="py-3 sm:py-6">

     <livewire:components.select-option colorText="text-grey" name="provinsi_id" label="Provinsi" :options="$this->provinces"
      wire:model.live="provinsi_id" :key="$this->provinces->pluck('id')->join('-')">
    </div>

    <div class="py-3 sm:py-6">
     <livewire:components.select-option colorText="text-grey" name="kota_id" label="Kota" :options="$this->regencies"
      wire:model.live="kota_id" :key="$this->regencies->pluck('id')->join('-')">
    </div>

    <div class="py-3 sm:py-6">
     <livewire:components.text-input colorText="text-grey" type="textarea" rows="4" name="alamat" label="Alamat"
      wire:model="alamat" placeholder="Jl. Perwira No. 50 Belakang Balok" />
    </div>

    <!-- Tujuan Kunjungan -->
    <div class="py-3 sm:py-6">
     @livewire(
         'components.check-box-input',
         [
             'name' => 'tujuan_kunjungan',
             'label' => 'Tujuan Kunjungan',
             'options' => [
                 'permintaan_data/peta' => 'Permintaan Data/Peta',
                 'konsultasi_statistik' => 'Konsultasi Statistik',
                 'permintaan_data_mikro' => 'Permintaan Data Mikro',
                 'romantik' => 'Romantik',
                 'lainnya' => 'Lainnya',
             ],
             'colorText' => 'text-grey',
             'input' => $tujuan_kunjungan,
         ],
         key('checkbox-input')
     )
    </div>

    <div class="pb-3 sm:pb-6">
     <div x-show="tujuanLainnya">
      <livewire:components.text-input colorText="text-grey" type="textarea" rows="4"
       name="tujuan_kunjungan_lainnya" wire:model="tujuan_kunjungan_lainnya" placeholder="Sebutkan tujuan lainnya" />
     </div>
    </div>

    <div class="flex items-center justify-end mt-6 gap-x-6">
     <button type="submit" wire:loading.attr="disabled"
      class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-bold text-white border border-transparent rounded-lg gap-x-2 sm:text-lg bg-lightYellow hover:bg-lightYellow/80 focus:outline-none focus:bg-lightYellow/80 disabled:opacity-50 disabled:pointer-events-none">
      <span wire:loading.remove>Kirim</span>
      <span wire:loading>
       <div role="status">
        <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-500"
         viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path
          d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
          fill="currentColor" />
         <path
          d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
          fill="currentFill" />
        </svg>
        <span class="sr-only">Loading...</span>
       </div>
      </span>
     </button>
    </div>
   </form>
  </div>
 </div>
</div>
