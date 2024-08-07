<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\GuestBook;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GuestBookChartByDate extends ChartWidget
{
    protected static ?string $heading = 'Total GuestBook per Month';

    protected static ?string $pollingInterval = '5s';

    public ?string $filter = '2024';
    protected function getData(): array
    {
        $year = $this->filter ?? date('Y');
        $guestBooks = GuestBook::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('created_at', $year)
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->keyBy('month');
        Log::info($guestBooks);

        $data = array_fill(1, 12, 0);

        foreach ($guestBooks as $month => $record) {
            $data[$month] = $record->count;
        }

        return [
            'datasets' => 
            [
                [
                    'label' => 'Total GuestBook',
                    'data' => array_values($data),
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                ],
            ],
            'labels' => [
                'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
            ],
        ];
    }

    protected function getFilters(): ?array
    {
        $years = GuestBook::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year', 'year')
            ->toArray();
        
        return 
            $years
        ;
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
