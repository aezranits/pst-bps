<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormPengaduanResource\Pages;
use App\Filament\Resources\FormPengaduanResource\RelationManagers;
use App\Models\FormPengaduan;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormPengaduanResource extends Resource
{
    protected static ?string $model = FormPengaduan::class;
    protected static ?string $navigationLabel = 'Pengaduan';

    protected static ?string $modelLabel = 'Pengaduans';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Pengaduan Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Group::make()->schema([
                Section::make('Identitas ')
                    ->description('Put the user name details in.')
                    ->schema([
                        TextInput::make('nama_lengkap')->required()->maxLength(255),
                        Textarea::make('alamat')->columnSpanFull(),
                        TextInput::make('pekerjaan')->maxLength(255),
                        TextInput::make('no_hp')->maxLength(255),
                        TextInput::make('email')->email()->maxLength(255),
                        Textarea::make('rincian_informasi')->columnSpanFull(),
                        Textarea::make('tujuan_penggunaan_informasi')->columnSpanFull(),
                        TextInput::make('cara_mendapatkan_salinan_informasi')->maxLength(255),
                        FileUpload::make('bukti_identitas_diri_path')
                            ->directory('bukti_identitas')
                            ->acceptedFileTypes(['image/svg+xml', 'image/png', 'image/jpeg', 'application/pdf'])
                            ->maxSize(2048),
                        ViewField::make('tanda_tangan')
                            ->view('components.signature-display') // Custom view untuk menampilkan gambar base64
                            ->columnSpanFull(),
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([Tables\Columns\TextColumn::make('nama_lengkap')->searchable(), Tables\Columns\TextColumn::make('pekerjaan')->searchable(), Tables\Columns\TextColumn::make('no_hp')->searchable(), Tables\Columns\TextColumn::make('email')->searchable(), Tables\Columns\TextColumn::make('cara_mendapatkan_salinan_informasi')->searchable(), Tables\Columns\TextColumn::make('bukti_identitas_diri_path')->searchable(), Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true), Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)])
            ->filters([
                //
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
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
            'index' => Pages\ListFormPengaduans::route('/'),
            'create' => Pages\CreateFormPengaduan::route('/create'),
            'edit' => Pages\EditFormPengaduan::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole('admin', 'petugas-pengaduan');
    }

    public static function authorizeResource(?string $resource = null): bool
    {
        return auth()->user()->hasAnyRole('admin', 'petugas-pengaduan');
    }
}
