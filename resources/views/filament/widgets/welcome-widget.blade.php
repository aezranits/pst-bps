<div class="dark:bg-gray-900 shadow rounded-3xl">
 <svg
  class="absolute inset-0 -z-10 h-full w-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)] dark:hidden"
  aria-hidden="true">
  <defs>
   <pattern id="83fd4e5a-9d52-42fc-97b6-718e5d7ee527" width="200" height="200" x="50%" y="-64"
    patternUnits="userSpaceOnUse">
    <path d="M100 200V.5M.5 .5H200" fill="none" />
   </pattern>
  </defs>
  <svg x="50%" y="-64" class="overflow-visible fill-gray-50">
   <path d="M-100.5 0h201v201h-201Z M699.5 0h201v201h-201Z M499.5 400h201v201h-201Z M299.5 800h201v201h-201Z"
    stroke-width="0" />
  </svg>
  <rect width="100%" height="100%" stroke-width="0" fill="url(#83fd4e5a-9d52-42fc-97b6-718e5d7ee527)" />
 </svg>
 <div class="px-4 sm:px-6 lg:mx-auto lg:max-w-6xl lg:px-8">
  <div class="py-6 md:flex md:items-center md:justify-between">
   <div class="min-w-0 flex-1">
    <!-- Profile -->
    <div class="flex items-center">
     <img class="hidden h-16 w-16 rounded-full sm:block"
      src="{{ auth()->user()->avatar_url ? Storage::url(auth()->user()->avatar_url) : asset('img/logo-pst.svg') }}"
      alt="User Avatar">
     <div>
      <div class="flex items-center">
       <img class="h-16 w-16 rounded-full sm:hidden"
        src="{{ auth()->user()->avatar_url ? Storage::url(auth()->user()->avatar_url) : asset('img/logo-pst.svg') }}"
        alt="">
       <h1 class="ml-3 text-2xl font-bold leading-7 capitalize sm:truncate sm:leading-9">Selamat datang,
        {{ $name }}</h1>
      </div>
      <dl class="mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap">
       <dd class="flex items-center text-sm font-medium  sm:mr-6">
        <svg class="mr-1.5 h-5 w-5 flex-shrink-0 " viewBox="0 0 20 20" fill="currentColor"
         aria-hidden="true">
         <path fill-rule="evenodd"
          d="M4 16.5v-13h-.25a.75.75 0 010-1.5h12.5a.75.75 0 010 1.5H16v13h.25a.75.75 0 010 1.5h-3.5a.75.75 0 01-.75-.75v-2.5a.75.75 0 00-.75-.75h-2.5a.75.75 0 00-.75.75v2.5a.75.75 0 01-.75.75h-3.5a.75.75 0 010-1.5H4zm3-11a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zM7.5 9a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-1zM11 5.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-1zm.5 3.5a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5h-1z"
          clip-rule="evenodd" />
        </svg>
        {{ $email }}
       </dd>
       <dt class="sr-only">Role</dt>
       <dd class="mt-3 flex items-center text-sm font-medium  sm:mr-6 sm:mt-0">
        <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-green-400" viewBox="0 0 20 20" fill="currentColor"
         aria-hidden="true">
         <path fill-rule="evenodd"
          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
          clip-rule="evenodd" />
        </svg>
        <p class="uppercase"> {{ $role }}</p>
       </dd>
      </dl>
     </div>
    </div>
   </div>
   @if (auth()->user()->hasRole('pst'))
    <div class="mt-6 flex space-x-3 md:ml-4 md:mt-0">
     <p
      class="inline-flex items-center rounded-md bg-yellow-400 px-3 py-2 text-sm font-semibold  shadow-sm ring-1 ring-inset ring-gray-300 ">
      Total Guest Books (Done): {{ $doneGuestBooks }}</p>
     <p
      class="inline-flex items-center rounded-md bg-yellow-400 px-3 py-2 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300">
      Feedback Rating: {{ $feedbackRating }} / 5</p>
    </div>
   @endif
  </div>
 </div>
</div>
