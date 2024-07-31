<?php

namespace App\Filament\Widgets;

use App\Enum\StatusRequestEnum;
use App\Models\GuestBook;
use App\Models\Request;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestGuestBooksWidget extends BaseWidget
{

    protected static ?string $heading = 'Daftar Guest Book';

    protected function getTableQuery(): Builder
    {
        return GuestBook::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('nama_lengkap')->label('Name'),
            TextColumn::make('email')->label('Email'),
            TextColumn::make('created_at')->label('Tanggal Pengisian')->date(),
            TextColumn::make('status')
                    ->badge()
                    ->label('Status')
                    ->getStateUsing(function ($record) {
                        $requestGuestBook = Request::where('guest_book_id', $record->id)->first();
                        return $requestGuestBook ? StatusRequestEnum::from($requestGuestBook->status)->getLabel() : 'Unknown';
                    })
                    ->color(function ($record) {
                        $requestGuestBook = Request::where('guest_book_id', $record->id)->first();
                        return $requestGuestBook ? StatusRequestEnum::from($requestGuestBook->status)->getColor() : 'gray';
                    }),
            TextColumn::make('petugas_pst_id')->label('Petugas PST'),
        ];
    }
}
