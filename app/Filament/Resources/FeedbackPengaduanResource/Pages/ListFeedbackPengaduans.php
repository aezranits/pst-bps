<?php

namespace App\Filament\Resources\FeedbackPengaduanResource\Pages;

use App\Filament\Resources\FeedbackPengaduanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeedbackPengaduans extends ListRecords
{
    protected static string $resource = FeedbackPengaduanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
