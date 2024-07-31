<?php

namespace App\Filament\Resources\GuestBookResource\Pages;

use App\Filament\Resources\GuestBookResource;
use App\Filament\Resources\GuestBookResource\Widgets\GuestBookOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGuestBooks extends ListRecords
{
    protected static string $resource = GuestBookResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            GuestBookOverview::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

}
