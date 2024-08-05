<?php

namespace App\Filament\Widgets;

use App\Models\GuestBook;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class GuestbookChart extends Widget
{
    protected static ?string $heading = 'Guestbook Statistics';

    protected function getFilters(): array
    {
        $years = GuestBook::select(DB::raw('YEAR(created_at) as year'))
            ->distinct()
            ->pluck('year', 'year');

        return [
            'year' => [
                'label' => 'Year',
                'options' => $years->toArray(),
                'default' => now()->year,
            ],
        ];
    }

    protected function getData(): array
    {
        $year = $this->filter('year') ?? now()->year;

        $guestbookData = GuestBook::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $guestbookData[$i]->count ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Guestbook Entries',
                    'data' => $data,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => [
                'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
            ],
        ];
    }
}

