<div class="pt-16 max-w-7xl mx-auto ">
	@livewire('partials.svg-background')
	
	<div class="relative flex w-full max-w-7xl mx-auto bg-lightBlue lg:rounded-3xl lg:m-5">
		<div x-data="{ show: false }" x-init="setTimeout(() => show = true, 400)" 
			x-show="show"
			x-transition:enter="transition transform ease-out duration-500"
			x-transition:enter-start="opacity-0 translate-x-[-20px]"
			x-transition:enter-end="opacity-100 translate-x-0"
			:class="{ 'invisible': !show, 'relative': show, 'absolute': !show }"
			class="aspect-h-2 aspect-w-3 overflow-hidden sm:aspect-w-5 lg:aspect-none lg:sticky lg:top-16 lg:h-screen w-1/2 bg-opacity-90 lg:block hidden p-5 ">
			@livewire('guest-book.side-image-guest-book')
		</div>
		<div x-data="{ show: false }" x-init="setTimeout(() => show = true, 400)" 
			x-show="show"
			x-transition:enter="transition transform ease-out duration-500"
			x-transition:enter-start="opacity-0 translate-x-[-20px]"
			x-transition:enter-end="opacity-100 translate-x-0"
			:class="{ 'invisible': !show, 'relative': show, 'absolute': !show }" class="lg:mx-8 md:mx-10 mx-8 pb-14 pt-10 lg:w-1/2 w-full" >
			<div class="" x-data="{ show: false }" x-init="setTimeout(() => show = true, 800)" 
				x-show="show"
				x-transition:enter="transition transform ease-out duration-500"
				x-transition:enter-start="opacity-0 translate-x-[-20px]"
				x-transition:enter-end="opacity-100 translate-x-0"
				:class="{ 'invisible': !show, 'relative': show, 'absolute': !show }">
				@livewire('guest-book.form-guest-book')
			</div>
		</div>
	</div>

	<div x-data='{show: false}' x-show= 'show' :class="{ 'hidden': !show }" x-on:open-modal.window = "show = true"
	x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 "
	x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
	x-transition:leave-start="opacity-100 " x-transition:leave-end="opacity-0 " class="hidden">
		@livewire('guest-book.modal-success')
	</div>
</div>
