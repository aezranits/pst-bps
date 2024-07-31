<?php 


namespace App\Filament\Widgets;

use App\Models\GuestBook;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

use Filament\Forms\Components\Select;

class GuestBookStatsWidget extends ChartWidget
{
    protected static ?string $heading = 'Guest Book Chart';

    protected function getFilters(): array
    {
        $years = range(now()->year, now()->year - 10);

        return [
            Select::make('year')
                ->label('Year')
                ->options(array_combine($years, $years))
                ->default(now()->year)
                ->reactive(),
            Select::make('month')
                ->label('Month')
                ->options([
                    '01' => 'January',
                    '02' => 'February',
                    '03' => 'March',
                    '04' => 'April',
                    '05' => 'May',
                    '06' => 'June',
                    '07' => 'July',
                    '08' => 'August',
                    '09' => 'September',
                    '10' => 'October',
                    '11' => 'November',
                    '12' => 'December',
                ])
                ->default(now()->format('m'))
                ->reactive(),
        ];
    }

    protected function getData(): array
    {
        $year = $this->filterFormData['year'] ?? now()->year;
        $month = $this->filterFormData['month'] ?? now()->format('m');

        $start = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $end = $start->copy()->endOfMonth();

        $guestBooks = GuestBook::whereBetween('created_at', [$start, $end])
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('d');
            });

        $data = [];
        foreach (range(1, $end->day) as $day) {
            $data[] = [
                'x' => $day,
                'y' => $guestBooks->has($day) ? $guestBooks[$day]->count() : 0,
            ];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Guest Book Entries',
                    'data' => $data,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}





