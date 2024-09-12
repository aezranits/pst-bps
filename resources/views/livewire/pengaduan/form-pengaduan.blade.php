<div x-data="{ caraMemperolehInformasi: '{{ $cara_memperoleh_informasi }}', caraMendapatkanSalinanInformasi: '{{ $cara_mendapatkan_salinan_informasi }}' }"
 @cara_memperoleh_informasi-changed.window="caraMemperolehInformasi = $event.detail; $wire.set('cara_memperoleh_informasi', caraMemperolehInformasi)"
 @cara_mendapatkan_salinan_informasi-changed.window="caraMendapatkanSalinanInformasi = $event.detail; $wire.set('cara_mendapatkan_salinan_informasi', caraMendapatkanSalinanInformasi)">
 <div>
  <div
   class="mt-5 lg:mt-0 space-y-8 border-b border-gray-900/10 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">
   <form wire:submit.prevent="submit">
    <!-- Nama Lengkap -->
    <div class="sm:py-6 py-3">
     <livewire:components.text-input label="Nama Lengkap" name="nama_lengkap" placeholder="Ade Setiawan"
      wire:model="nama_lengkap" />
    </div>

    <div class="sm:py-6 py-3">
     <livewire:components.text-input type="textarea" rows="4" name="alamat" label="Alamat" wire:model="alamat"
      placeholder="Jl. Perwira No. 50 Belakang Balok, Kota Bukittinggi, Provinsi Sumatera Barat" />
    </div>

    <div class="sm:pb-6 pb-3">
     <livewire:components.text-input label="Pekerjaan" name="pekerjaan" placeholder="" wire:model="pekerjaan" placeholder="Pegawai Negeri Sipil" />
    </div>

    <div class="sm:py-6 py-3">
     <livewire:components.text-input type="tel" label="No HP" name="no_hp" wire:model="no_hp"
      placeholder="081234567890" pattern="[0-9]*" inputmode="numeric" />
    </div>

    <div class="sm:py-6 py-3">
     <livewire:components.text-input label="Email" name="email" placeholder="pstbps@gmail.com" type="email"
      wire:model="email" />
    </div>

    <div class="sm:py-6 py-3">
     <livewire:components.text-input type="textarea" rows="5" name="rincian_informasi"
      label="Rincian Informasi yang Dibutuhkan" wire:model="rincian_informasi"
      placeholder="1. Permohonan informasi ketersediaan lowongan magang untuk mahasiswa Kampus UIN SMDD       
2. Pemasukkan surat permohonan magang dan kontak narahubung 
3. Permohonan informasi untuk konfirmasi kesediaan penerimaan magang untuk mahasiswa Kampus UIN SMDD" />
    </div>

    <div class="sm:py-6 py-3">
     <livewire:components.text-input label="Tujuan Penggunaan Informasi" name="tujuan_penggunaan_informasi"
      placeholder="Permohonan Konfirmasi Magang dari Kampus UIN SMDD" wire:model="tujuan_penggunaan_informasi" />
    </div>

    <!-- Jenis Kelamin -->
    <div class="sm:py-6 py-3">

     <livewire:components.radio-button-input name="cara_memperoleh_informasi" label="Cara Memperoleh Informasi"
      :options="[
          'melihat/membaca/mendengarkan/mencatat' => 'Melihat / membaca / mendengarkan / mencatat',
          'mendapatkan_salinan_informasi(hardcopy/softcopy)' => 'Mendapatkan salinan informasi (Hardcopy/Softcopy)',
      ]" />
    </div>
    <div class="sm:py-6 py-3">

     <livewire:components.radio-button-input name="cara_mendapatkan_salinan_informasi"
      label="Cara Mendapatkan Salinan Informasi" :options="[
          'mengambil_langsung' => 'Mengambil Langsung',
          'kurir' => 'Kurir',
          'pos' => 'Pos',
          'faksimili' => 'Faksimili',
          'email' => 'Email',
      ]" />
    </div>

    <div class="sm:py-6 py-3">
     <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 ">
      <label for="bukti_identitas_diri_path" class="block sm:text-lg text-sm font-bold leading-6 ">
       Bukti Identitas Diri
      </label>
      <div class="mt-2 sm:col-span-2 sm:mt-0">
       <div class="h-full">
        <input
         class="block w-full sm:text-lg text-sm  text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
         aria-describedby="file_input_help" id="bukti_identitas_diri_path" type="file"
         name="bukti_identitas_diri_path" wire:model="bukti_identitas_diri_path">
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG atau PDF (MAX.2MB).
        </p>
       </div>

       @error('bukti_identitas_diri_path')
        <span class="text-red-500 text-sm">{{ $message }}</span>
       @enderror
      </div>
     </div>
    </div>

    <div class="sm:py-6 py-3">
     <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 ">
      <label for="dokumen_permintaan_informasi_publik_path" class="block sm:text-lg text-sm font-bold leading-6 ">
       Dokumen Formulir Permintaan Publik
      </label>
      <div class="mt-2 sm:col-span-2 sm:mt-0">
       <div class="h-full">
        <input
         class="block w-full sm:text-lg text-sm  text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
         aria-describedby="file_input_help" id="dokumen_permintaan_informasi_publik_path" type="file"
         name="dokumen_permintaan_informasi_publik_path" wire:model="dokumen_permintaan_informasi_publik_path">
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG atau PDF (MAX.2MB).
        </p>
       </div>

       @error('dokumen_permintaan_informasi_publik_path')
        <span class="text-red-500 text-sm">{{ $message }}</span>
       @enderror
      </div>
     </div>
    </div>

    <div class="sm:py-6 py-3">
     <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 ">
      <label for="dokumen_pernyataan_keberatan_atas_permohonan_informasi_path"
       class="block sm:text-lg text-sm font-bold leading-6 ">
       Dokumen Pernyataan Keberatan Atas Permohonan Informasi
      </label>
      <div class="mt-2 sm:col-span-2 sm:mt-0">
       <div class="h-full">
        <input
         class="block w-full sm:text-lg text-sm  text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
         aria-describedby="file_input_help" id="dokumen_pernyataan_keberatan_atas_permohonan_informasi_path"
         type="file" name="dokumen_pernyataan_keberatan_atas_permohonan_informasi_path"
         wire:model="dokumen_pernyataan_keberatan_atas_permohonan_informasi_path">
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG atau PDF (MAX.2MB).
        </p>
       </div>

       @error('dokumen_pernyataan_keberatan_atas_permohonan_informasi_path')
        <span class="text-red-500 text-sm">{{ $message }}</span>
       @enderror
      </div>
     </div>
    </div>

    <div class="sm:py-6 py-3 mx-auto flex flex-col items-center">
      <label class="block sm:text-lg text-sm  font-semibold text-center pb-3 text-gray-700">Tanda Tangan</label>
     <div class="w-fit">
      <div class="border border-gray-300 rounded-lg p-2">
        <canvas id="signature-pad" class="border"></canvas>
      </div>
      <div class="flex justify-end w-full mt-2">
        <button type="button" id="clear-signature" class="bg-red-500 text-white py-1 px-4 rounded">Hapus</button>
       </div>
     </div>
     
     @error('tanda_tangan')
      <span class="text-red-500 text-sm">{{ $message }}</span>
     @enderror
    </div>



    <div class="flex items-center justify-end mt-6 gap-x-6">
     <button type="submit" wire:loading.attr="disabled"
      class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 sm:text-lg text-sm font-bold rounded-lg border border-transparent bg-lightYellow text-white hover:bg-lightYellow/80 focus:outline-none focus:bg-lightYellow/80 disabled:opacity-50 disabled:pointer-events-none">
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

@script
 <script>
  document.addEventListener('DOMContentLoaded', function() {
   const canvas = document.getElementById('signature-pad');
   const signaturePad = new SignaturePad(canvas);

   document.getElementById('clear-signature').addEventListener('click', function() {
    signaturePad.clear();
   });

   document.querySelector('form').addEventListener('submit', function() {
    @this.set('tanda_tangan', signaturePad.toDataURL());
   });
  });
 </script>
@endscript
