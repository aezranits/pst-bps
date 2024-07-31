<?php
namespace App\Filament\Widgets;

use App\Models\Feedback;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestFeedbackWidget extends BaseWidget
{
    protected static string $view = 'filament.widgets.latest-feedback-widget';
    protected static ?string $heading = 'Feedback Terbaru';
    protected function getTableQuery(): Builder
    {
        return Feedback::query()->latest();
    }

    protected function getTableColumns(): array
    {

        return [
            TextColumn::make('petugas_pst_id')->label('Petugas PST'),
            TextColumn::make('front_office_id')->label('Front Office'),
            TextColumn::make('kritik_saran')->label('Kritik & Saran'),
        ];
    }
}
