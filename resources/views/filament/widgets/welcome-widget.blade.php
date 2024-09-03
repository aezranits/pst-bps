<div class="dark:bg-gray-900 bg-white shadow rounded-xl">
  <svg class="absolute inset-0 -z-10 h-full w-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)] dark:hidden" aria-hidden="true">
   <defs>
    <pattern id="83fd4e5a-9d52-42fc-97b6-718e5d7ee527" width="200" height="200" x="50%" y="-64" patternUnits="userSpaceOnUse">
     <path d="M100 200V.5M.5 .5H200" fill="none" />
    </pattern>
   </defs>
   <svg x="50%" y="-64" class="overflow-visible fill-gray-50">
    <path d="M-100.5 0h201v201h-201Z M699.5 0h201v201h-201Z M499.5 400h201v201h-201Z M299.5 800h201v201h-201Z"
     stroke-width="0" />
   </svg>
   <rect width="100%" height="100%" stroke-width="0" fill="url(#83fd4e5a-9d52-42fc-97b6-718e5d7ee527)" />
  </svg>
  <div class="mx-auto max-w-7xl lg:px-14 px-8">
   <div class="md:py-8 py-4 xl:flex xl:items-center xl:justify-between ">
    <div class="min-w-0 flex-1">
     <div class="flex items-center space-x-3"> <!-- Menggunakan flex dan memberikan space antara elemen -->
       <!-- Bagian gambar profil -->
       <div>
         <img class="rounded-xl object-fill h-32 w-32"
          src="{{ auth()->user()->avatar_url ? Storage::url(auth()->user()->avatar_url) : asset('img/logo-pst.svg') }}"
          alt="User Avatar">
       </div>
 
       <!-- Bagian informasi pengguna -->
       <div class="xl:pt-0 pt-4">
         <div class="ml-3"> 
           <h1 class="text-xl font-bold leading-7 capitalize text-green-400">Selamat datang</h1>
           <h1 class=" text-2xl font-bold leading-7 capitalize">{{ Str::limit($name, 15) }}</h1>
           <h1 class="uppercase text-green-400"> {{ $role }}</h1>
         </div>
       </div>
     </div>
    </div>
 
    {{-- @if (auth()->user()->hasRole('pst')) --}}
     <div class="pt-6 flex justify-center space-x-3 md:ml-4 md:mt-0">
      <p class="inline-flex items-center text-center justify-center w-1/2 rounded-md dark:text-green-400 px-3 py-2 md:text-sm text-xs font-semibold shadow-sm ring-1 ring-inset ring-gray-300">
       Total kunjungan yang ditangani : {{ $doneGuestBooks }}
      </p>
      <p class="inline-flex items-center w-1/2 text-center justify-center rounded-md dark:text-green-400 px-3 py-2 md:text-sm text-xs font-semibold shadow-sm ring-1 ring-inset ring-gray-300">
       Rating : {{ $feedbackRating }} / 5
      </p>
     </div>
    {{-- @endif --}}
   </div>
  </div>
 </div>
 