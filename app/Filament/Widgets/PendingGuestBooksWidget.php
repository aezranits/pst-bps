<?php

namespace App\Filament\Widgets;

use App\Enum\StatusRequestEditEnum;
use App\Models\GuestBook;
use App\Models\Request;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class PendingGuestBooksWidget extends BaseWidget
{
    protected static ?string $heading = 'Daftar Guest Book In Pending';

    protected function getTableQuery(): Builder
    {
        return GuestBook::query()->whereHas('requests', function($query) {
            $query->where('status', 'pending');
        });
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->label('ID'),
            TextColumn::make('nama_lengkap')->label('Name'),
            TextColumn::make('email')->label('Email'),
            TextColumn::make('created_at')->label('Tanggal Pengisian')->date(),
            TextColumn::make('tujuan_kunjungan')->label('Tujuan Kunjungan'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('accept')
                ->label('Accept')
                ->action(function (GuestBook $record) {
                    $this->accept($record->id);
                })
                ->color('success'),
        ];
    }

    public function accept($id)
    {
        $request = Request::where('guest_book_id', $id)->first();
        $request->status = 'inProgress';
        $request->save();

        $guestBook = GuestBook::find($id);
        $guestBook->petugas_pst_id = Auth::id();
        $guestBook->save();
    }

}


