<nav class="" x-data="{ open: false }">
	{{-- Primary Navigation Menu --}}
	<div aria-label="Top" class="fixed top-0 left-0 right-0 z-10 bg-darkBlue bg-opacity-90 backdrop-blur-xl backdrop-filter">
		<div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
			<div class="flex items-center h-16">
				<!-- Logo -->
				<div class="flex justify-center ml-4 lg:ml-0">
					<a href="/">
						<div class="flex items-center w-auto gap-2">
							<img class="h-8" src='{{ asset('img/logo-pst.svg') }}' alt="Logo PST" />
							<div class="mt-2 text-white">
								<p class="-my-2 font-semibold lg:text-base">Pelayanan Statistik Terpadu</p>
								<p class="text-sm">BPS Kota Bukittinggi</p>
							</div>
						</div>
				</div>


				<div class="flex items-center ml-auto">
					<div class="hidden font-semibold lg:flex lg:items-center lg:justify-end gap-x-2">
                        <a  href="/" wire:navigate  class="{{ request()->is('/')? 'bg-grey text-black' : 'text-white' }} py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent  hover:bg-grey hover:text-black focus:outline-none focus:bg-gray-100  focus:text-black disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                Home
                        </a>
                        <a  href="/buku-tamu" wire:navigate class=" {{ request()->is('buku-tamu')? 'bg-grey text-black' : 'text-white' }} py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent hover:bg-grey hover:text-black focus:outline-none focus:bg-gray-100 focus:text-black disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                Buku Tamu
                        </a>
                        <a href="/feedback" wire:navigate class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent {{ request()->is('feedback')? 'bg-grey text-black' : 'text-white' }} hover:bg-grey hover:text-black focus:outline-none focus:bg-gray-100 focus:text-black disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                Feedback
                        </a>
                        <a href="/about-us" wire:navigate class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent {{ request()->is('about-us')? 'bg-grey text-black' : 'text-white' }} hover:bg-grey hover:text-black focus:outline-none focus:bg-gray-100 focus:text-black disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                Tentang Kami
                        </a>
                        <a href="/user/login" wire:navigate class="py-2 px-6 bg-lightYellow inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-black hover:bg-lightYellow/95 focus:outline-none focus:bg-lightYellow/95  disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                Login
                        </a>
					</div>
				</div>

				<button type="button" class="relative p-2 text-gray-400 bg-white rounded-md lg:hidden" @click="open = ! open"'>
					<span class="absolute -inset-0.5"></span>
					<span class="sr-only">Open menu</span>
					<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
						aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
					</svg>
				</button>
			</div>
		</div>
	</div>

	<!-- Responsive Navigation Menu -->
	<div :class="{ 'block': open, 'hidden': !open }" class="relative z-40 hidden lg:hidden" role="dialog"
		aria-modal="true">


		<div :class="{ 'opacity-100': open, 'opacity-0': !open }"
			class="fixed inset-0 transition-opacity duration-300 ease-linear bg-black bg-opacity-25 opacity-100"
			aria-hidden="true"></div>

		<div class="fixed inset-0 z-40 flex">

			<div :class="{ 'translate-x-0': open, '-translate-x-full': !open }"
				class="relative flex flex-col w-full max-w-xs pb-12 overflow-y-auto transition duration-300 ease-in-out transform bg-white shadow-xl">
				<div class="flex px-4 pt-5 pb-2">
					<button type="button" class="relative inline-flex items-center justify-center p-2 -m-2 text-gray-400 rounded-md"
						@click="open = ! open">
						<span class="absolute -inset-0.5"></span>
						<span class="sr-only">Close menu</span>
						<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
							aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
						</svg>
					</button>
				</div>

				<!-- Links -->
				<div class="px-4 py-2 border-b border-gray-200">
					<div class="flow-root px-2 py-2 hover:bg-lightYellow {{ request()->is('/')? 'bg-lightYellow' : '' }}">
						<a wire:navigate href="/"  class="block p-2 -m-2 font-medium text-gray-900 hover:text-white">Beranda</a>
					</div>
					<div class="flow-root px-2 py-2 hover:bg-lightYellow {{ request()->is('buku-tamu')? 'bg-lightYellow' : '' }}">
						<a wire:navigate href="/buku-tamu" class="block p-2 -m-2 font-medium text-gray-900 hover:text-white">Buku Tamu</a>
					</div>
					<div class="flow-root px-2 py-2 hover:bg-lightYellow {{ request()->is('feedback')? 'bg-lightYellow' : '' }}">
						<a wire:navigate href="/feedback" class="block p-2 -m-2 font-medium text-gray-900 hover:text-white">Feedback</a>
					</div>
					<div class="flow-root px-2 py-2 hover:bg-lightYellow {{ request()->is('about-us')? 'bg-lightYellow' : '' }}">
						<a wire:navigate href="/about-us" class="block p-2 -m-2 font-medium text-gray-900 hover:text-white">Tentang Kami</a>
					</div>
				</div>

				<div class="px-4 py-2 border-t border-gray-200">
					<div class="flow-root px-2 py-2 hover:bg-lightYellow">
						<a wire:navigate href="#" class="block p-2 -m-2 font-medium text-gray-900 hover:text-white">Login</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>
