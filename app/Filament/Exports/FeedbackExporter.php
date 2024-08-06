<?php

namespace App\Filament\Exports;

use App\Models\Feedback;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class FeedbackExporter extends Exporter
{
    protected static ?string $model = Feedback::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('nama_lengkap'),
            ExportColumn::make('petugasPst.name'),
            ExportColumn::make('frontOffice.name'),
            ExportColumn::make('kepuasan_petugas_pst'),
            ExportColumn::make('kepuasan_petugas_front_office'),
            ExportColumn::make('kepuasan_sarana_prasarana'),
            ExportColumn::make('kritik_saran'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your feedback export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
