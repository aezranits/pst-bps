<div class="pt-16 ">
	@livewire('partials.svg-background')
	
	<div class="relative flex w-full max-w-7xl mx-auto bg-darkBlue lg:rounded-3xl m-5">
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
			<div class="lg:col-start-2" x-data="{ show: false }" x-init="setTimeout(() => show = true, 800)" 
				x-show="show"
				x-transition:enter="transition transform ease-out duration-500"
				x-transition:enter-start="opacity-0 translate-x-[-20px]"
				x-transition:enter-end="opacity-100 translate-x-0"
				:class="{ 'invisible': !show, 'relative': show, 'absolute': !show }">
				@livewire('guest-book.form-guest-book')
			</div>
		</div>
	</div>
</div>
