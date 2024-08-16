<?php
 
namespace App\Filament\Pages;

use App\Filament\Widgets\GuestBookChartByDate;
use App\Filament\Widgets\TopStaffWidget;
use App\Filament\Widgets\WelcomeWidget;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Log;

class Dashboard extends \Filament\Pages\Dashboard implements HasForms
{
    use HasFiltersForm;

    public function getWidgets(): array
    {
        return [
            WelcomeWidget::class,
            TopStaffWidget::class,
            GuestBookChartByDate::class,
        ];
    }
}