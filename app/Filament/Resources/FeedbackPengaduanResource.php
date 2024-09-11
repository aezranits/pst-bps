<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackPengaduanResource\Pages;
use App\Filament\Resources\FeedbackPengaduanResource\RelationManagers;
use App\Models\FeedbackPengaduan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeedbackPengaduanResource extends Resource
{
    protected static ?string $model = FeedbackPengaduan::class;

    protected static ?string $navigationLabel = 'Feedback Pengaduan';

    protected static ?string $modelLabel = 'Feedback Pengaduans';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Pengaduan Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_lengkap')
                    ->maxLength(255),
                Forms\Components\TextInput::make('petugas_pengaduan')
                    ->numeric(),
                Forms\Components\TextInput::make('kepuasan_petugas_pengaduan')
                    ->numeric(),
                Forms\Components\Textarea::make('kritik_saran')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('petugas_pengaduan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kepuasan_petugas_pengaduan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedbackPengaduans::route('/'),
            'create' => Pages\CreateFeedbackPengaduan::route('/create'),
            'edit' => Pages\EditFeedbackPengaduan::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole('admin','petugas-pengaduan');
    }

    public static function authorizeResource(?string $resource = null): bool
    {
        return auth()->user()->hasAnyRole('admin','petugas-pengaduan');
    }
}
