<form wire:submit.prevent="submit" class="lg:flex-auto">
	<div class="grid grid-cols-1 gap-x-8 gap-y-4 sm:grid-cols-2">
		<div class="sm:col-span-2">
			<label for="nama_lengkap" class="block text-sm font-semibold leading-6 text-gray-900">Nama Lengkap</label>
			<div class="mt-3">
				<input id="nama_lengkap" name="nama_lengkap" rows="4" wire:model="nama_lengkap" type='text'
				 class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></input>
			</div>
            @error('nama_lengkap')
				<span class="text-red-500">{{ $message }}</span>
            @enderror
		</div>
		<!-- Petugas PST Section -->
		<div>
			<label for="petugas-pst" class="block text-sm font-medium leading-6 text-gray-900">Petugas PST</label>
			<div class="relative mt-3">
				<select wire:model="petugas_pst" id="petugas-pst" 
					class="select-2 w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
					<option value="">Pilih Petugas PST</option>
					@foreach ($petugasPst as $user)
						<option value="{{ $user->id }}">{{ $user->name }}</option>
					@endforeach
				</select>
                @error('petugas_pst')
					<span class="text-red-500">{{ $message }}</span>
                @enderror
			</div>
		</div>

		<!-- Petugas PST Rating Section -->
        <div x-data="{
            rating: @entangle('kepuasan_petugas_pst'),
            hoverRating: 0,
            ratings: [{'amount': 1, 'label':'Terrible'}, {'amount': 2, 'label':'Bad'}, {'amount': 3, 'label':'Okay'}, {'amount': 4, 'label':'Good'}, {'amount': 5, 'label':'Great'}],
            rate(amount) {
                if (this.rating == amount) {
                    this.rating = 0;
                } else {
                    this.rating = amount;
                }
            },
            currentLabel() {
                let r = this.rating;
                if (this.hoverRating != this.rating) r = this.hoverRating;
                let i = this.ratings.findIndex(e => e.amount == r);
                if (i >= 0) {
                    return this.ratings[i].label;
                } else {
                    return '';
                }
            }
        }" class="flex flex-col items-center">
            <label class="block text-sm font-semibold leading-6 text-gray-900">Bagaimana Anda menilai pelayanan keseluruhan dari petugas PST?</label>
            <div class="relative mt-2">
                <div class="flex items-center space-x-0 justify-center">
                    <template x-for="(star, index) in ratings" :key="index">
                        <button type="button" @click="rate(star.amount)" @mouseover="hoverRating = star.amount" @mouseleave="hoverRating = rating" aria-hidden="true" :title="star.label" class="rounded-sm text-gray-400 fill-current focus:outline-none focus:shadow-outline p-1 w-12 m-0 cursor-pointer" :class="{'text-gray-600': hoverRating >= star.amount, 'text-yellow-400': rating >= star.amount && hoverRating >= star.amount}">
                            <svg class="w-15 transition duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </button>
                    </template>
                </div>
                <div class="p-2 flex items-center justify-center text-lightYellow">
                    <template x-if="rating || hoverRating">
                        <p x-text="currentLabel()"></p>
                    </template>
                    <template x-if="!rating && !hoverRating">
                        <p>Berikan Rating!</p>
                    </template>
                </div>
                @error('kepuasan_petugas_pst')
					<span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

		<!-- Front Office Section -->
		<div>
			<label for="front-office" class="block text-sm font-medium leading-6 text-gray-900">Front Office</label>
			<div class="relative mt-2">
				<select wire:model="front_office" id="front-office"
					class="select-2 w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
					<option value="">Pilih Front Office</option>
					@foreach ($frontOffice as $user)
						<option value="{{ $user->id }}">{{ $user->name }}</option>
					@endforeach
				</select>
                @error('front_office')
					<span class="text-red-500">{{ $message }}</span>
                @enderror
			</div>
		</div>
		
		<!-- Front Office Rating Section -->
		<div x-data="{
            rating: @entangle('kepuasan_petugas_front_office'),
            hoverRating: 0,
            ratings: [{'amount': 1, 'label':'Terrible'}, {'amount': 2, 'label':'Bad'}, {'amount': 3, 'label':'Okay'}, {'amount': 4, 'label':'Good'}, {'amount': 5, 'label':'Great'}],
            rate(amount) {
				console.log('Rating amount:', amount);
                if (this.rating == amount) {
                    this.rating = 0;
                } else {
                    this.rating = amount;
                }
            },
            currentLabel() {
                let r = this.rating;
                if (this.hoverRating != this.rating) r = this.hoverRating;
                let i = this.ratings.findIndex(e => e.amount == r);
                if (i >= 0) {
                    return this.ratings[i].label;
                } else {
                    return '';
                }
            }
        }" class="flex flex-col items-center">
            <label class="block text-sm font-semibold leading-6 text-gray-900">Bagaimana Anda menilai pelayanan keseluruhan dari Front Office?</label>
            <div class="relative mt-2">
                <div class="flex items-center space-x-0  justify-center">
                    <template x-for="(star, index) in ratings" :key="index">
                        <button type="button" @click="rate(star.amount)" @mouseover="hoverRating = star.amount" @mouseleave="hoverRating = rating" aria-hidden="true" :title="star.label" class="rounded-sm text-gray-400 fill-current focus:outline-none focus:shadow-outline p-1 w-12 m-0 cursor-pointer" :class="{'text-gray-600': hoverRating >= star.amount, 'text-yellow-400': rating >= star.amount && hoverRating >= star.amount}">
                            <svg class="w-15 transition duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </button>
                    </template>
                </div>
                <div class="p-2 flex items-center justify-center text-lightYellow">
                    <template x-if="rating || hoverRating">
                        <p x-text="currentLabel()"></p>
                    </template>
                    <template x-if="!rating && !hoverRating">
                        <p>Berikan Rating!</p>
                    </template>
                </div>
                @error('kepuasan_petugas_front_office')
					<span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

		<!-- Sarana dan Prasarana Section -->
		<div x-data="{
            rating: @entangle('kepuasan_sarana_prasarana'),
            hoverRating: 0,
            ratings: [{'amount': 1, 'label':'Terrible'}, {'amount': 2, 'label':'Bad'}, {'amount': 3, 'label':'Okay'}, {'amount': 4, 'label':'Good'}, {'amount': 5, 'label':'Great'}],
            rate(amount) {
				console.log('Rating amount:', amount);
                if (this.rating == amount) {
                    this.rating = 0;
                } else {
                    this.rating = amount;
                }
            },
            currentLabel() {
                let r = this.rating;
                if (this.hoverRating != this.rating) r = this.hoverRating;
                let i = this.ratings.findIndex(e => e.amount == r);
                if (i >= 0) {
                    return this.ratings[i].label;
                } else {
                    return '';
                }
            }
        }" class="flex flex-col items-center sm:col-span-2">
            <label class="block text-sm font-semibold leading-6 text-gray-900">Bagaimana Anda menilai pelayanan keseluruhan dari Sarana Prasarana?</label>
            <div class="relative mt-2">
                <div class="flex items-center space-x-0 justify-center ">
                    <template x-for="(star, index) in ratings" :key="index">
                        <button type="button" @click="rate(star.amount)" @mouseover="hoverRating = star.amount" @mouseleave="hoverRating = rating" aria-hidden="true" :title="star.label" class="rounded-sm text-gray-400 fill-current focus:outline-none focus:shadow-outline p-1 w-12 m-0 cursor-pointer" :class="{'text-gray-600': hoverRating >= star.amount, 'text-yellow-400': rating >= star.amount && hoverRating >= star.amount}">
                            <svg class="w-15 transition duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </button>
                    </template>
                </div>
                <div class="p-2 flex items-center justify-center" class="text-lightYellow">
                    <template x-if="rating || hoverRating" >
                        <p x-text="currentLabel()" class="text-lightYellow"></p>
                    </template>
                    <template x-if="!rating && !hoverRating" >
                        <p class="text-lightYellow">Berikan Rating!</p>
                    </template>
                </div>
                @error('kepuasan_sarana_prasarana')
					<span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

		<div class="sm:col-span-2">
			<label for="message" class="block text-sm font-semibold leading-6 text-gray-900 sm:text-center">Kritik dan Saran</label>
			<div class="mt-3">
				<textarea id="message" name="message" rows="4" wire:model="kritik_saran" type='text'
				 class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
			</div>
            @error('kritik_saran')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
		</div>

	</div>

	<div class="mt-10">
		<button type="submit"
			class="block w-full rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Kirim</button>
	</div>

	<div x-data='{show: false}' x-show= 'show' :class="{ 'hidden': !show }" x-on:open-modal.window = "show = true"
	x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 "
	x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
	x-transition:leave-start="opacity-100 " x-transition:leave-end="opacity-0 " class="hidden">
		@livewire('feedback.modal-success-send')
	</div>
</form>

@assets
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endassets
@script
<script>

$(document).ready(function() {
    // Inisialisasi select2 untuk petugas PST
    $('#petugas-pst').select2({
        width: 'resolve'
    }).on('change', function(e) {
        var selectedValue = $(this).val();
        @this.set('petugas_pst', selectedValue);
    });

    // Inisialisasi select2 untuk front office
    $('#front-office').select2({
        width: 'resolve'
    }).on('change', function(e) {
        var selectedValue = $(this).val();
        @this.set('front_office', selectedValue);
    });
});
</script>
@endscript