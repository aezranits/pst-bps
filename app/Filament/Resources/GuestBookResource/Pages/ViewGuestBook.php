<?php

namespace App\Filament\Resources\GuestBookResource\Pages;

use App\Filament\Resources\GuestBookResource;
use App\Models\Request;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGuestBook extends ViewRecord
{
    protected static string $resource = GuestBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $requestGuestBook = Request::where('guest_book_id', $data['id'])->first();
        $data['status'] = $requestGuestBook['status'] ?? 'null';
        $data['response'] = $requestGuestBook['response'] ?? 'null';
        return $data;
    }
}
