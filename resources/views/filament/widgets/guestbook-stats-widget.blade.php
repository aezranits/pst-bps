<div>
    <div class="mb-4">
        <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
        <select id="year" name="year" wire:model="year" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            @foreach($years as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="filterType" class="block text-sm font-medium text-gray-700">Filter Type</label>
        <select id="filterType" name="filterType" wire:model="filterType" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            <option value="month">Per Month</option>
            <option value="purpose">Per Purpose</option>
            <option value="job">Per Job</option>
        </select>
    </div>

    <canvas id="guestBookChart"></canvas>

    <script>
        document.addEventListener('livewire:load', function () {
            const ctx = document.getElementById('guestBookChart').getContext('2d');
            let guestBookChart = new Chart(ctx, {
                type: 'line',
                data: @json($chartData),
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });

            Livewire.on('updateChart', data => {
                guestBookChart.data = data;
                guestBookChart.update();
            });
        });
    </script>
</div>
