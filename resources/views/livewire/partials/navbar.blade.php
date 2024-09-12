<nav class="" x-data="{ open: false }">
	{{-- Primary Navigation Menu --}}
	<div aria-label="Top" class="fixed top-0 left-0 right-0 z-10 bg-darkBlue bg-opacity-90 backdrop-blur-xl backdrop-filter">
		<div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
			<div class="flex items-center h-16">
				<!-- Logo -->
				<div class="flex justify-center ml-4 lg:ml-0">
					<a href="{{ route('home') }}">
						<div class="flex items-center w-auto gap-2">
							<img class="h-6" src='{{ asset('img/logo-ppid.png') }}' alt="Logo PPID" />
							<img class="h-8" src='{{ asset('img/logo-pst.svg') }}' alt="Logo PST" />
							<div class="mt-2 text-white">
								<p class="-my-2 font-semibold lg:text-base">Pelayanan Statistik Terpadu</p>
								<p class="text-sm font-semibold">BPS KOTA BUKITTINGGI</p>
							</div>
						</div>
				</div>


				<div class="flex items-center ml-auto">
					<div class="hidden font-semibold lg:flex lg:items-center lg:justify-end gap-x-2">
                        <a  href="{{ route('home') }}" wire:navigate  class="{{ request()->is('/')? 'bg-grey text-black' : 'text-white' }} py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent  hover:bg-grey hover:text-black focus:outline-none focus:bg-gray-100  focus:text-black disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                Home
                        </a>
						<div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
							<a href="{{ route('guest-book') }}" wire:navigate 
							   class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent {{ request()->is('buku-tamu*')? 'bg-grey text-black' : 'text-white' }} hover:bg-grey hover:text-black focus:outline-none focus:bg-gray-100 focus:text-black disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
								Buku Tamu
								<svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
								</svg>
							</a>
						
							<!-- Dropdown -->
							<div x-show="open" 
								 x-transition:enter="transition ease-out duration-200" 
								 x-transition:enter-start="opacity-0 transform scale-95" 
								 x-transition:enter-end="opacity-100 transform scale-100" 
								 x-transition:leave="transition ease-in duration-75" 
								 x-transition:leave-start="opacity-100 transform scale-100" 
								 x-transition:leave-end="opacity-0 transform scale-95" 
								 class="absolute right-0 z-20 w-48 mt-2 origin-top-left bg-white rounded-md shadow-lg ring-1 ring-white ring-opacity-10 focus:outline-none ">
								<div class="p-1" role="none">
									<a wire:navigate href="{{ route('guest-book') }}" class=" {{ request()->is('buku-tamu')? 'bg-lightYellow/90 text-white' : 'text-black' }} block px-4 py-2 mb-1 text-sm hover:bg-lightYellow hover:text-white ">Layanan Buku Tamu</a>
									<a wire:navigate href="{{ route('guest-book.feedback') }}" class=" {{ request()->is('buku-tamu/feedback')? 'bg-lightYellow/90 text-white' : 'text-black' }} block px-4 py-2 text-sm hover:bg-lightYellow hover:text-white ">Feedback</a>
								</div>
							</div>
						</div>
						<div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
							<a href="{{ route('pengaduan') }}" wire:navigate 
							   class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent {{ request()->is('pengaduan*') ? 'bg-grey text-black' : 'text-white' }} hover:bg-grey hover:text-black focus:outline-none focus:bg-gray-100 focus:text-black disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
								Pengaduan
								<svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
								</svg>
							</a>
						
							<!-- Dropdown -->
							<div x-show="open" 
								 x-transition:enter="transition ease-out duration-200" 
								 x-transition:enter-start="opacity-0 transform scale-95" 
								 x-transition:enter-end="opacity-100 transform scale-100" 
								 x-transition:leave="transition ease-in duration-75" 
								 x-transition:leave-start="opacity-100 transform scale-100" 
								 x-transition:leave-end="opacity-0 transform scale-95" 
								 class="absolute right-0 z-20 w-48 mt-2 origin-top-left bg-white rounded-md shadow-lg ring-1 ring-white ring-opacity-10 focus:outline-none ">
								<div class="p-1" role="none">
									<a wire:navigate href="{{ route('pengaduan') }}" class=" {{ request()->is('pengaduan')? 'bg-lightYellow/90 text-white' : 'text-black' }} block px-4 py-2 mb-1 text-sm hover:bg-lightYellow hover:text-white ">Layanan Pengaduan</a>
									<a wire:navigate href="{{ route('pengaduan.feedback') }}" class=" {{ request()->is('pengaduan/feedback')? 'bg-lightYellow/90 text-white' : 'text-black' }} block px-4 py-2 text-sm hover:bg-lightYellow hover:text-white ">Feedback</a>
								</div>
							</div>
						</div>
                        
                        <a href="{{ route('about-us') }}" wire:navigate class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent {{ request()->is('tentang-kami')? 'bg-grey text-black' : 'text-white' }} hover:bg-grey hover:text-black focus:outline-none focus:bg-gray-100 focus:text-black disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                Tentang Kami
                        </a>
                        <a href="/user/login" wire:navigate class="py-2 px-6 bg-lightYellow text-white inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-black hover:bg-lightYellow/95 focus:outline-none focus:bg-lightYellow/95  disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
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

		 <!-- Sidebar -->
		 <div x-show="open" class="relative z-40 lg:hidden" role="dialog" aria-modal="true">

			<!-- Background overlay -->
			<div @click="open = false" class="fixed inset-0 bg-black bg-opacity-25 transition-opacity duration-300 ease-linear" 
				:class="{ 'opacity-100': open, 'opacity-0': !open }" aria-hidden="true"></div>
	
			<!-- Sidebar container -->
			<div class="fixed inset-0 z-40 flex justify-end">
				<div
					x-show="open"
					x-transition:enter="transition ease-out duration-300"
					x-transition:enter-start="translate-x-full opacity-0"
					x-transition:enter-end="translate-x-0 opacity-100"
					x-transition:leave="transition ease-in duration-300"
					x-transition:leave-start="translate-x-0 opacity-100"
					x-transition:leave-end="translate-x-full opacity-0"
					class="relative flex flex-col w-full max-w-xs pb-12 overflow-y-auto bg-white shadow-xl transform">
	
					<!-- Tombol Close -->
					<div 
						class="flex px-4 pt-5 pb-2" >
						<button type="button"
							class="relative inline-flex items-center justify-center p-2 -m-2 text-gray-400 rounded-md ml-auto"
							@click="open = false">
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
						<div class="flow-root px-2 py-2 hover:bg-lightYellow hover:text-white {{ request()->is('/')? 'bg-lightYellow text-white' : '' }}">
							<a wire:navigate href="{{ route('home') }}" class="block p-2 -m-2 font-medium text-gray-900 hover:text-white">Beranda</a>
						</div>

						<!-- Dropdown Menu GuestBook -->
						<div x-data="{ dropdownOpen: false }" class="flow-root px-2 py-2">
							<a @click="dropdownOpen = !dropdownOpen"
								class="flex justify-between items-center p-2 -m-2 font-medium  hover:text-white hover:bg-lightYellow cursor-pointer {{ request()->is('buku-tamu*')? 'bg-lightYellow text-white' : 'text-gray-900' }}">
								Buku Tamu
								<svg :class="{ 'rotate-180': dropdownOpen }"
									class="w-4 h-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24"
									stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M19 9l-7 7-7-7" />
								</svg>
							</a>
	
							<!-- Dropdown content -->
							<div x-show="dropdownOpen"
								x-transition:enter="transition ease-out duration-200"
								x-transition:enter-start="opacity-0 transform scale-95"
								x-transition:enter-end="opacity-100 transform scale-100"
								x-transition:leave="transition ease-in duration-75"
								x-transition:leave-start="opacity-100 transform scale-100"
								x-transition:leave-end="opacity-0 transform scale-95"
								class="mt-3 space-y-2">
								<a href="{{ route('guest-book') }}"
									class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100  {{ request()->is('buku-tamu')? 'bg-gray-100 ' : '' }}">Layanan Buku Tamu</a>
								<a href="{{ route('guest-book.feedback') }}"
									class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100  {{ request()->is('buku-tamu/feedback')? 'bg-gray-100 ' : '' }}">Feedback</a>
			
							</div>
						</div>

						<!-- Dropdown Menu Pengaduan -->
						<div x-data="{ dropdownOpen: false }" class="flow-root px-2 py-2">
							<a @click="dropdownOpen = !dropdownOpen"
								class="flex justify-between items-center p-2 -m-2 font-medium  hover:text-white hover:bg-lightYellow cursor-pointer {{ request()->is('pengaduan*')? 'bg-lightYellow text-white' : 'text-gray-900' }}">
								Pengaduan
								<svg :class="{ 'rotate-180': dropdownOpen }"
									class="w-4 h-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24"
									stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M19 9l-7 7-7-7" />
								</svg>
							</a>
	
							<!-- Dropdown content -->
							<div x-show="dropdownOpen"
								x-transition:enter="transition ease-out duration-200"
								x-transition:enter-start="opacity-0 transform scale-95"
								x-transition:enter-end="opacity-100 transform scale-100"
								x-transition:leave="transition ease-in duration-75"
								x-transition:leave-start="opacity-100 transform scale-100"
								x-transition:leave-end="opacity-0 transform scale-95"
								class="mt-3 space-y-2">
								<a href="{{ route('pengaduan') }}"
									class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100  {{ request()->is('pengaduan')? 'bg-gray-100 ' : '' }}">Layanan Pengaduan</a>
								<a href="{{ route('pengaduan.feedback') }}"
									class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100  {{ request()->is('pengaduan/feedback')? 'bg-gray-100 ' : '' }}">Feedback</a>
			
							</div>
						</div>
	
						<div class="flow-root px-2 py-2 hover:bg-lightYellow hover:text-white {{ request()->is('tentang-kami')? 'bg-lightYellow text-white' : '' }}">
							<a wire:navigate href="{{ route('about-us') }}" class="block p-2 -m-2 font-medium text-gray-900 hover:text-white">Tentang Kami</a>
						</div>
					</div>
	
					<!-- Login -->
					<div class="px-4 py-2 border-t border-gray-200">
						<div class="flow-root px-2 py-2 hover:bg-lightYellow hover:text-white">
							<a wire:navigate href="/user/login" class="block p-2 -m-2 font-medium text-gray-900 hover:text-white">Login</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
</nav>
