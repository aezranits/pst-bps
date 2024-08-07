<?php
 
namespace App\Filament\Pages;

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
    // protected static string $routePath = '/dashboard';
    // public function getTitle(): string | Htmlable
    // {
    //     return 'Dashborad';
    // }
    
    // public function filtersForm(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             Section::make('')
    //                 ->schema([
    //                     DatePicker::make('startDate'),
    //                     DatePicker::make('endDate'),
    //                     // ...
    //                 ])
    //                 ->columns(3),
    //         ]);
    // }

    public function getWidgets(): array
    {
        Log::info('test');
        return [
            WelcomeWidget::class,
            TopStaffWidget::class,
        ];
    }
}