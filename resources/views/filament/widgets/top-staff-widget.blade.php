{{-- <div class=" p-4 rounded-xl h-full">
    <h3 class="text-4xl font-bold text-center m-4">Top Staff Members</h3>
    <div class="flex justify-between flex-wrap">
        @if($topPetugasPST)
        <div class="flex-1 m-2">
            <div class="sm:flex bg-white p-4 rounded-xl border border-gray-300 h-full flex-col">
                    <div class="w-full flex justify-center">
                        <h4 class="text-3xl font-bold">Petugas PST</h4>
                    </div>
                    <div class="">
                        <p class="mt-1">Nama: {{ $topPetugasPST->name }}</p>
                        <p class="mt-1">Rating: {{ number_format($topPetugasPST->avg_rating, 2).'/5.00' }}</p>
                        <p class="mt-1">Guest Books Handled: {{ $topPetugasPST->guestbook_count }}</p>
                    </div>
            </div>
        </div>
        @endif
        @if($topFrontOffice)
        <div class="flex-1 m-2">
            <div class="sm:flex bg-white p-4 rounded-xl border border-gray-300 h-full flex-col">
                <div class="w-full flex justify-center">
                    <h4 class="text-3xl font-bold">Petugas Front Office</h4>
                </div>
                <div>
                    <p class="mt-1">Nama: {{ $topFrontOffice->name }}</p>
                    <p class="mt-1">Rating: {{ number_format($topFrontOffice->avg_rating, 2).'/5.00' }}</p>
                    <p class="mt-1">Guest Books Handled: {{ $topFrontOffice->guestbook_count }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div> --}}

<div class="mt-8 ">
    <div class="mx-auto max-w-7xl ">
      <h2 class="text-2xl font-bold leading-6 text-gray-900">Top Staff Member</h2>
      <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 ">
        <!-- Card -->
        @if($topPetugasPST)

        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                  <a href="#" class="font-medium text-cyan-700 hover:text-cyan-900">Petugas PST</a>
                </div>
              </div>
            <div class="p-5">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z" />
                </svg>
              </div>
              <div class="ml-5 w-0 flex-1">
                <dl>
                  <dt class=" text-lg font-medium text-gray-900">{{ $topPetugasPST->name }}</dt>
                  <dd>
                    <div class="truncate text-sm font-medium text-gray-500">{{ number_format($topPetugasPST->avg_rating, 2).'/5.00' }}</div>
                  </dd>
                </dl>
              </div>
            </div>
          </div>
        </div>
        @endif
        @if($topFrontOffice)
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                  <a href="#" class="font-medium text-cyan-700 hover:text-cyan-900">Petugas Front Office</a>
                </div>
              </div>
            <div class="p-5">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z" />
                </svg>
              </div>
              <div class="ml-5 w-0 flex-1">
                <dl>
                  <dt class=" text-lg font-medium text-gray-900">{{ $topFrontOffice->name }}</dt>
                  <dd>
                    <div class="truncate text-sm font-medium text-gray-500">{{ number_format($topFrontOffice->avg_rating, 2).'/5.00' }}</div>
                  </dd>
                </dl>
              </div>
            </div>
          </div>
        </div>
        @endif

        <!-- More items... -->
      </div>
    </div>
</div>