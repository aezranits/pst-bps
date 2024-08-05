<div class="bg-white shadow p-6 rounded-3xl ">
 <div class="mx-auto max-w-7xl ">
  <h2 class="text-3xl font-bold leading-6 text-gray-900 text-center pb-4">Petugas Pelayanan Terbaik</h2>
  <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2">

   <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="bg-blue-500 py-3 text-center">
     <div class="text-sm ">
      <a href="#" class="font-medium text-white " >Petugas PST</a>
     </div>
    </div>
    <div class="p-5">
     <div class="flex items-center">
       <div class="ml-5 w-0 flex-1 relative mx-auto flex flex-col items-center text-center ">
        <h1 class="text-2xl font-bold tracking-tight lg:text-4xl">{{ $topPetugasPST->petugasPst->name ?? 'N/A' }}</h1>
        <a href="#"
         class="mt-6 inline-block rounded-md border border-transparent bg-yellow-400 px-8 py-3 text-base font-medium  hover:bg-yellow-300">Rating
         : {{ number_format($topPetugasPST->avg_rating ?? 0, 2) . '/5.00' }}</a>
       </div>
      </div>
     </div>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
     <div class="bg-blue-500 text-center py-3">
      <div class="text-sm">
       <a href="#" class="font-medium text-white">Petugas Front Office</a>
      </div>
     </div>
     <div class="p-5">
      <div class="flex items-center">
       <div class="ml-5 w-0 flex-1 relative mx-auto flex flex-col items-center text-center ">
        <h1 class="text-2xl font-bold tracking-tight lg:text-4xl">{{ $topFrontOffice->frontOffice->name ?? 'N/A' }}</h1>
        <a href="#"
         class="mt-6 inline-block rounded-md border border-transparent bg-yellow-400 px-8 py-3 text-base font-medium  hover:bg-yellow-300">Rating
         : {{ number_format($topFrontOffice->avg_rating ?? 0, 2) . '/5.00' }}</a>
       </div>
      </div>
     </div>
    </div>

    <!-- More items... -->
   </div>
  </div>
 </div>
