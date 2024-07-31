<div x-data="{ show: false }" x-init="show = true" class="relative bg-lightBlue h-screen flex items-center">
    <div aria-hidden="true" class="absolute inset-0 overflow-hidden blur-lg">
        <img src="{{ asset('img/cover-gedung.png') }}" alt="" class="object-cover object-center w-full h-full">
    </div>
    <div aria-hidden="true" class="absolute inset-0 opacity-50 bg-lightBlue"></div>

    <div x-show="show" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" class="relative flex flex-col items-center max-w-3xl px-6 py-32 mx-auto text-center sm:py-64 lg:px-0">
        <div class="text-4xl font-bold lg:text-6xl">
            <h1 class="text-lightYellow">Buku Tamu</h1>
            <h1 class=" text-grey md:text-nowrap">Pelayanan Statistik Terpadu</h1>
        </div>
        <div class="mt-4">
            <p class="text-white lg:text-lg">Selamat datang di Pelayanan Statistik Terpadu BPS Bukittinggi. Di website ini Anda dapat menemukan berbagai layanan yang kami sediakan dan informasi kontak yang dapat dihubungi.</p>
        </div>
        <div class="mt-6">
            <a href="/buku-tamu" class="py-2 px-8 md:py-3 md:px-10 bg-lightYellow inline-flex items-center gap-x-2 text-lg md:text-xl font-medium rounded-lg border border-transparent text-black hover:bg-lightYellow/95 focus:outline-none focus:bg-lightYellow/95 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                Isi Buku Tamu
            </a>
        </div>
    </div>
</div>
