<div x-data="{ pekerjaan: '', tujuanLainnya: false }" class="space-y-12 sm:space-y-16">
	
	<div>
		<h2 class="text-4xl font-bold leading-7 text-grey lg:hidden block">Buku Tamu</h2>

		<div
			class="pb-10 mt-5 lg:mt-0 space-y-8 border-b border-gray-900/10 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">
			<div x-data="{ show: true }" x-show="show">
				@if (session()->has('success'))
					<div class="bg-green-500 text-white p-4 rounded-md">
						{{ session('success') }}
					</div>
				@endif
			
				@if (session()->has('error'))
					<div class="bg-red-500 text-white p-4 rounded-md">
						{{ session('error') }}
					</div>
				@endif
			</div>
			<form wire:submit.prevent="submit">
				<!-- Nama Lengkap -->
				<div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
					<label for="nama-lengkap" class="block text-sm font-medium leading-6 text-grey sm:pt-1.5">Nama Lengkap</label>
					<div class="mt-2 sm:col-span-2 sm:mt-0">
						<input type="text" wire:model="nama_lengkap" id="nama-lengkap" autocomplete="family-name"
						placeholder="Budi Setiawan" class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lightYellow sm:max-w-xs sm:text-sm sm:leading-6">
						@error('nama_lengkap')
							<span class="text-red-500">{{ $message }}</span>
						@enderror
					</div>
				</div>

				<!-- Jenis Kelamin -->
				<fieldset>
					<legend class="sr-only">Jenis Kelamin</legend>
					<div class="sm:grid sm:grid-cols-3 sm:items-baseline sm:gap-4 sm:py-6">
						<div class="text-sm font-semibold leading-6 text-grey" aria-hidden="true">Jenis Kelamin</div>
						<div class="mt-1 sm:col-span-2 sm:mt-0">
							<div class="max-w-lg">
								<div class="space-y-6">
									<div class="flex items-center gap-x-3">
										<input id="laki_laki" wire:model="jenis_kelamin" value="Laki-Laki" name="jenis_kelamin" type="radio"
											class="w-4 h-4 text-lightYellow border-gray-300 focus:ring-lightYellow">
										<label for="laki_laki" class="block text-sm font-medium leading-6 text-grey">Laki-Laki</label>
									</div>
									<div class="flex items-center gap-x-3">
										<input id="perempuan" wire:model="jenis_kelamin" value="Perempuan" name="jenis_kelamin" type="radio"
											class="w-4 h-4 text-lightYellow border-gray-300 focus:ring-lightYellow">
										<label for="perempuan" class="block text-sm font-medium leading-6 text-grey">Perempuan</label>
									</div>
								</div>
							</div>
							@error('jenis_kelamin')
								<span class="text-red-500">{{ $message }}</span>
							@enderror
						</div>
					</div>
				</fieldset>

				<!-- Umur -->
				<div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
					<label for="usia" class="block text-sm font-semibold leading-6 text-grey sm:pt-1.5">Usia</label>
					<div class="mt-2 sm:col-span-1 sm:mt-0">
						<div
							class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-lightYellow sm:max-w-md">
							<input type="number" wire:model="usia" id="usia" autocomplete="usia"
								class="block rounded-l-md flex-1 border-0 bg-white py-1.5 pl-3 text-black placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
								placeholder="25" min="1" max="150">
							<span class="flex select-none rounded-r-md items-center pl-3 pr-3 text-black bg-white sm:text-sm">Tahun</span>
						</div>
						@error('usia')
							<span class="text-red-500">{{ $message }}</span>
						@enderror
					</div>
				</div>

				<!-- Pekerjaan -->
				<fieldset>
					<legend class="sr-only">Pekerjaan</legend>
					<div class="sm:grid sm:grid-cols-3 sm:items-baseline sm:gap-4 sm:py-6">
						<div class="text-sm font-semibold leading-6 text-grey" aria-hidden="true">Pekerjaan</div>
						<div class="mt-1 sm:col-span-2 sm:mt-0">
							<div class="max-w-lg">
								<div class="space-y-6">
									<div class="flex items-center gap-x-3">
										<input id="mahasiswa" x-model="pekerjaan" wire:model="pekerjaan" value="mahasiswa" name="pekerjaan" type="radio"
											class="w-4 h-4 text-lightYellow border-gray-300 focus:ring-lightYellow">
										<label for="mahasiswa" class="block text-sm font-medium leading-6 text-grey">Mahasiswa</label>
									</div>
									<div class="flex items-center gap-x-3">
										<input id="dinas_instansi_opd" x-model="pekerjaan" wire:model="pekerjaan" value="dinas/instansi/opd"
											name="pekerjaan" type="radio" class="w-4 h-4 text-lightYellow border-gray-300 focus:ring-lightYellow">
										<label for="dinas_instansi_opd"
											class="block text-sm font-medium leading-6 text-grey">Dinas/Instansi/OPD</label>
									</div>
									<div class="flex items-center gap-x-3">
										<input id="peneliti" x-model="pekerjaan" value="peneliti" name="pekerjaan" wire:model="pekerjaan" type="radio"
											class="w-4 h-4 text-lightYellow border-gray-300 focus:ring-lightYellow">
										<label for="peneliti" class="block text-sm font-medium leading-6 text-grey">Peneliti</label>
									</div>
									<div class="flex items-center gap-x-3">
										<input id="umum" x-model="pekerjaan" value="umum" name="pekerjaan" wire:model="pekerjaan" type="radio"
											class="w-4 h-4 text-lightYellow border-gray-300 focus:ring-lightYellow">
										<label for="umum" class="block text-sm font-medium leading-6 text-grey">Umum</label>
									</div>
								</div>
							</div>
							@error('pekerjaan')
								<span class="text-red-500">{{ $message }}</span>
							@enderror
						</div>
					</div>
				</fieldset>

				<!-- Conditional Inputs -->
				<template x-if="pekerjaan === 'mahasiswa'">
					<div>
						<div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
							<label for="jurusan" class="block text-sm font-medium leading-6 text-grey sm:pt-1.5">Jurusan</label>
							<div class="mt-2 sm:col-span-2 sm:mt-0">
								<input type="text" wire:model="jurusan" id="jurusan" autocomplete="jurusan"
									class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lightYellow sm:max-w-xs sm:text-sm sm:leading-6">
								@error('jurusan')
									<span class="text-red-500">{{ $message }}</span>
								@enderror

							</div>
						</div>
						<div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
							<label for="asal-universitas" class="block text-sm font-medium leading-6 text-grey sm:pt-1.5">Asal
								Universitas</label>
							<div class="mt-2 sm:col-span-2 sm:mt-0">
								<input type="text" wire:model="asal_universitas" id="asal-universitas" autocomplete="family-name"
									class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lightYellow sm:max-w-xs sm:text-sm sm:leading-6">
								@error('asal_universitas')
									<span class="text-red-500">{{ $message }}</span>
								@enderror

							</div>
						</div>
					</div>
				</template>
				<template x-if="pekerjaan === 'dinas/instansi/opd'">
					<div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
						<label for="asal" class="block text-sm font-medium leading-6 text-grey sm:pt-1.5">Asal</label>
						<div class="mt-2 sm:col-span-2 sm:mt-0">
							<input type="text" wire:model="asal" id="asal" autocomplete="asal"
								class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lightYellow sm:max-w-xs sm:text-sm sm:leading-6">
							@error('asal')
								<span class="text-red-500">{{ $message }}</span>
							@enderror

						</div>
					</div>
				</template>
				<template x-if="pekerjaan === 'peneliti'">
					<div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
						<label for="asal-universitas-lembaga" class="block text-sm font-medium leading-6 text-grey sm:pt-1.5">Asal
							Universitas/Lembaga Penelitian</label>
						<div class="mt-2 sm:col-span-2 sm:mt-0">
							<input type="text" wire:model="asal_universitas_lembaga" id="asal-universitas-lembaga"
								autocomplete="asal-universitas-lembaga"
								class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lightYellow sm:max-w-xs sm:text-sm sm:leading-6">
							@error('asal_universitas_lembaga')
								<span class="text-red-500">{{ $message }}</span>
							@enderror

						</div>
					</div>
				</template>
				<template x-if="pekerjaan === 'umum'">
					<div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
						<label for="organisasi-nama-perusahaan-kantor"
							class="block text-sm font-medium leading-6 text-grey sm:pt-1.5">Organisasi/Nama Perusahaan/Kantor</label>
						<div class="mt-2 sm:col-span-2 sm:mt-0">
							<input type="text" wire:model="organisasi_nama_perusahaan_kantor"
								id="organisasi-nama-perusahaan-kantor" autocomplete="organisasi-nama-perusahaan-kantor"
								class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lightYellow sm:max-w-xs sm:text-sm sm:leading-6">
							@error('organisasi_nama_perusahaan_kantorKantor')
								<span class="text-red-500">{{ $message }}</span>
							@enderror
						</div>
					</div>
				</template>
				<div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
					<label for="no-hp" class="block text-sm font-semibold leading-6 text-grey sm:pt-1.5">No. HP</label>
					<div class="mt-2 sm:col-span-1 sm:mt-0">
						<input type="tel" name="no-hp" id="no-hp" wire:model="no_hp" pattern="[0-9]*" inputmode="numeric"
							class="block flex-1 rounded-md border-0 bg-white py-1.5 pl-3 text-black placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
							placeholder="08123456789">
						@error('no_hp')
							<span class="text-red-500">{{ $message }}</span>
						@enderror
					</div>
				</div>

				<div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
					<label for="email" class="block text-sm font-medium leading-6 text-grey sm:pt-1.5">Email address</label>
					<div class="mt-2 sm:col-span-2 sm:mt-0">
						<input type="text" name="email" id="email" wire:model='email' autocomplete="email"
						placeholder="pstbps@gmail.com"  class="block w-full rounded-md border-0
							 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lightYellow sm:max-w-xs sm:text-sm sm:leading-6">
						@error('email')
							<span class="text-red-500">{{ $message }}</span>
						@enderror

					</div>
				</div>

				<div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
					<label for="alamat" class="block text-sm font-medium leading-6 text-grey sm:pt-1.5">Alamat</label>
					<div class="mt-2 sm:col-span-2 sm:mt-0">
						<input type="text" name="alamat" id="alamat" autocomplete="alamat" wire:model='alamat'
						placeholder="Jl. Perwira No.50, Belakang Balok, Kec. Aur Birugo Tigo Baleh, Kota Bukittinggi, Sumatera Barat 26181"	class="block w-full rounded-md border-0 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lightYellow sm:max-w-xl sm:text-sm sm:leading-6">
						@error('alamat')
							<span class="text-red-500">{{ $message }}</span>
						@enderror

					</div>
				</div>

				<div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
					<label for="provinsi" class="block text-sm font-medium leading-6 text-grey sm:pt-1.5">Provinsi</label>
					<div class="mt-2 sm:col-span-2 sm:mt-0">
						<select type="text" name="selectedProvince" id="provinsi" wire:model='selectedProvince'
							placeholder="Sumatera Barat" class="block w-full rounded-md border-0 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lightYellow sm:max-w-xs sm:text-sm sm:leading-6">
							<option value="">Pilih Provinsi</option>
							@foreach ($provinces as $province)
								<option value="{{ $province["id"] }}">{{ $province["name"] }}</option>
							@endforeach
						</select>
						@error('provinsi')
							<span class="text-red-500">{{ $message }}</span>
						@enderror

					</div>
				</div>

				<div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
					<label for="kota" class="block text-sm font-medium leading-6 text-grey sm:pt-1.5">Kota</label>
					<div class="mt-2 sm:col-span-2 sm:mt-0">
						<select name="kota" id="kota" autocomplete="kota" wire:model='kota'
						 placeholder="Bukittinggi"	class="block w-full rounded-md border-0 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lightYellow sm:max-w-xs sm:text-sm sm:leading-6">
						 <option value="">Pilih Kota</option>
						 @if(!empty($regencies))
							@foreach ($regencies as $regency)
								<option value="{{ $regency["name"] }}">{{ $regency["name"] }}</option>
							@endforeach
						@endif
						</select>
						@error('kota')
							<span class="text-red-500">{{ $message }}</span>
						@enderror

					</div>
				</div>

				

				<fieldset>
					<legend class="sr-only">Tujuan Kunjungan</legend>
					<div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:py-6">
						<div class="text-sm font-semibold leading-6 text-grey" aria-hidden="true">Tujuan Kunjungan</div>
						<div class="mt-4 sm:col-span-2 sm:mt-0">
							<div class="max-w-lg space-y-6">
								<div class="relative flex gap-x-3">
									<div class="flex items-center h-6">
										<input id="permintaan_data/peta" wire:model='tujuan_kunjungan' value="permintaan_data/peta"
											name="permintaan_data/peta" type="checkbox"
											class="w-4 h-4 text-lightYellow border-gray-300 rounded focus:ring-lightYellow">
									</div>
									<div class="text-sm leading-6">
										<label for="permintaan_data/peta" class="font-medium text-grey">Permintaan Data/Peta</label>
									</div>
								</div>
								<div class="relative flex gap-x-3">
									<div class="flex items-center h-6">
										<input id="konsultasi_statistik" wire:model='tujuan_kunjungan' value="konsultasi_statistik"
											name="konsultasi_statistik" type="checkbox"
											class="w-4 h-4 text-lightYellow border-gray-300 rounded focus:ring-lightYellow">
									</div>
									<div class="text-sm leading-6">
										<label for="konsultasi_statistik" class="font-medium text-grey">Konsultasi Statistik</label>
									</div>
								</div>
								<div class="relative flex gap-x-3">
									<div class="flex items-center h-6">
										<input id="permintaan_data_mikro" wire:model='tujuan_kunjungan' value="permintaan_data_mikro"
											name="permintaan_data_mikro" type="checkbox"
											class="w-4 h-4 text-lightYellow border-gray-300 rounded focus:ring-lightYellow">
									</div>
									<div class="text-sm leading-6">
										<label for="permintaan_data_mikro" class="font-medium text-grey">Permintaan Data Mikro</label>
									</div>
								</div>
								<div class="relative flex gap-x-3">
									<div class="flex items-center h-6">
										<input id="romantik" wire:model='tujuan_kunjungan' value="romantik" name="romantik" type="checkbox"
											class="w-4 h-4 text-lightYellow border-gray-300 rounded focus:ring-lightYellow">
									</div>
									<div class="text-sm leading-6">
										<label for="romantik" class="font-medium text-grey">Romantik</label>
									</div>
								</div>
								<div class="relative flex gap-x-3">
									<div class="flex items-center h-6">
										<input id="lainnya" x-model="tujuanLainnya" wire:model='tujuan_kunjungan' value="lainnya"
											name="lainnya" type="checkbox"
											class="w-4 h-4 text-lightYellow border-gray-300 rounded focus:ring-lightYellow">
									</div>
									<div class="text-sm leading-6">
										<label for="lainnya" class="font-medium text-grey">Lainnya</label>
									</div>
								</div>
							</div>
							@error('tujuan_kunjungan')
								<span class="text-red-500">{{ $message }}</span>
							@enderror

						</div>
					</div>
				</fieldset>

				<div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4" x-show="tujuanLainnya">
					<label for="tujuan-lainnya" class="block text-sm font-medium leading-6 text-grey"></label>
					<div class="mt-2 sm:col-span-2 sm:mt-0">
						<input type="text" wire:model='tujuan_kunjungan_lainnya' name="tujuan-lainnya" id="tujuan-lainnya"
							autocomplete="tujuan-lainnya"
							class="block w-full rounded-md border-0 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lightYellow sm:max-w-xs sm:text-sm sm:leading-6"
							placeholder="Sebutkan tujuan lainnya">
						@error('tujuan_kunjungan_lainnya')
							<span class="text-red-500">{{ $message }}</span>
						@enderror

					</div>
				</div>

				<div class="flex items-center justify-end mt-6 gap-x-6">
					<button type="submit"
						class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-lightYellow text-white hover:bg-lightYellow/80 focus:outline-none focus:bg-lightYellow/80 disabled:opacity-50 disabled:pointer-events-none">
						Kirim
					</button>
				</div>
			</form>

		</div>
	</div>
	<div x-data='{show: false}' x-show= 'show' :class="{ 'hidden': !show }" x-on:open-modal.window = "show = true"
	x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 "
	x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
	x-transition:leave-start="opacity-100 " x-transition:leave-end="opacity-0 " class="hidden">
		@livewire('guest-book.modal-success')
	</div>

</div>

@script
<script>
$(document).ready(function() {
    // Inisialisasi select2 untuk petugas PST
    $('#provinsi').select2({
        width: 'resolve'
    }).on('change', function(e) {
        var selectedValue = $(this).val();
        @this.set('selectedProvince', selectedValue);
    });

    // Inisialisasi select2 untuk front office
    $('#kota').select2({
        width: 'resolve'
    }).on('change', function(e) {
        var selectedValue = $(this).val();
        @this.set('kota', selectedValue);
    });
});
</script>
@endscript
