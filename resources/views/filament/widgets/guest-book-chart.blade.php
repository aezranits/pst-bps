<div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.0/dist/alpine.min.js" defer></script>
    <select x-data @change="window.livewire.emit('refreshChart')" wire:model="year">
        @foreach(range(now()->year, now()->year - 10) as $yearOption)
            <option value="{{ $yearOption }}">{{ $yearOption }}</option>
        @endforeach
    </select>

    <canvas id="guestbookStatsChart"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('guestbookStatsChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: @json($this->getData()),
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            window.livewire.on('refreshChart', function () {
                chart.data = @json($this->getData());
                chart.update();
            });
        });
    </script>
</div>

