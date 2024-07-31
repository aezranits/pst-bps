<?php

namespace App\Filament\Resources\GuestBookResource\Pages;

use App\Filament\Resources\GuestBookResource;
use App\Models\Request;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class EditGuestBook extends EditRecord
{
    protected static string $resource = GuestBookResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\ViewAction::make(), Actions\DeleteAction::make()];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $requestGuestBook = Request::where('guest_book_id', $data['id'])->first();
        $data['status'] = $requestGuestBook['status'] ?? 'null';
        $data['response'] = $requestGuestBook['response'] ?? 'null';
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);
        $requestGuestBook = $record->requests()->first();
        if ($requestGuestBook) {
            $requestGuestBook->update([
                'status' => $data['status'] ?? '',
                'response' => $data['response'] ?? '',
            ]);
        }

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
