<form wire:submit.prevent="submit" class="lg:flex-auto">
	<div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
		<!-- Petugas PST Section -->
		<div>
			<label for="petugas-pst" class="block text-sm font-medium leading-6 text-gray-900">Petugas PST</label>
			<div class="relative mt-3">
				<select wire:model="petugas_pst_id" id="petugas-pst"
					class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
					<option value="">Pilih Petugas PST</option>
					@foreach ($petugasPst as $user)
						<option value="{{ $user->id }}">{{ $user->name }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<!-- Petugas PST Rating Section -->
        <div x-data="{ rating: @entangle('kepuasan_petugas_pst'), hoverRating: 0 }">
			<label class="block text-sm font-semibold leading-6 text-gray-900">Bagaimana Anda menilai pelayanan keseluruhan dari petugas PST?</label>
			<div class="relative mt-2">
				<div class="flex items-center space-x-1">
					<template x-for="star in [1, 2, 3, 4, 5]" :key="star">
						<label @mouseenter="hoverRating = star" @mouseleave="hoverRating = 0">
							<input type="radio" x-model="rating" :value="star" class="hidden" />
							<svg class="h-10 w-10 flex-shrink-0 cursor-pointer" :class="{ 'text-yellow-500': hoverRating >= star || rating >= star, 'text-gray-400': hoverRating < star && rating < star }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
							</svg>
						</label>
					</template>
				</div>
			</div>
		</div>

		<!-- Front Office Section -->
		<div>
			<label for="front-office" class="block text-sm font-medium leading-6 text-gray-900">Front Office</label>
			<div class="relative mt-2">
				<select wire:model="front_office_id" id="front-office"
					class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-12 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
					<option value="">Pilih Front Office</option>
					@foreach ($frontOffice as $user)
						<option value="{{ $user->id }}">{{ $user->name }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<!-- Front Office Rating Section -->
		<div x-data="{ rating: @entangle('kepuasan_petugas_front_office'), hoverRating: 0 }">
			<label class="block text-sm font-semibold leading-6 text-gray-900">Bagaimana Anda menilai pelayanan keseluruhan dari Front Office?</label>
			<div class="relative mt-2">
				<div class="flex items-center space-x-1">
					<template x-for="star in [1, 2, 3, 4, 5]">
						<label @mouseenter="hoverRating = star" @mouseleave="hoverRating = 0">
							<input type="radio" x-model="rating" :value="star" class="hidden" />
							<svg class="h-10 w-10 flex-shrink-0 cursor-pointer" :class="{ 'text-yellow-500': hoverRating >= star || rating >= star, 'text-gray-400': hoverRating < star && rating < star }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
							</svg>
						</label>
					</template>
				</div>
			</div>
		</div>

		<!-- Sarana dan Prasarana Section -->
		<div class="sm:col-span-2 sm:flex sm:flex-col sm:justify-center sm:items-center" x-data="{ rating: @entangle('kepuasan_sarana_prasarana'), hoverRating: 0 }">
			<label class="block text-sm font-semibold leading-6 text-gray-900">Bagaimana Anda menilai Sarana dan Prasarana?</label>
			<div class="relative mt-2">
				<div class="flex items-center space-x-1">
					<template x-for="star in [1, 2, 3, 4, 5]">
						<label @mouseenter="hoverRating = star" @mouseleave="hoverRating = 0">
							<input type="radio" x-model="rating" :value="star" class="hidden" />
							<svg class="h-10 w-10 flex-shrink-0 cursor-pointer" :class="{ 'text-yellow-500': hoverRating >= star || rating >= star, 'text-gray-400': hoverRating < star && rating < star }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
							</svg>
						</label>
					</template>
				</div>
			</div>
		</div>

		<div class="sm:col-span-2 sm:text-center">
			<label for="message" class="block text-sm font-semibold leading-6 text-gray-900">Kritik dan Saran</label>
			<div class="mt-3">
				<textarea id="message" name="message" rows="4" wire:model="kritik_saran" type='text'
				 class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
			</div>
		</div>

	</div>

	<div class="mt-10">
		<button type="submit"
			class="block w-full rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Kirim</button>
	</div>
</form>
