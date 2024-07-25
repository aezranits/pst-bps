<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestBookResource\Pages;
use App\Filament\Resources\GuestBookResource\RelationManagers;
use App\Models\GuestBook;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GuestBookResource extends Resource
{
    protected static ?string $model = GuestBook::class;

    protected static ?string $navigationLabel = 'Guest Book';

    protected static ?string $modelLabel = 'Guest Books';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'System Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Identitas Pribadi')
                    ->description('Put the user name details in.')
                    ->schema([
                        TextInput::make('nama_lengkap')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                        TextInput::make('usia')
                            ->required()
                            ->numeric(),
                        Select::make('jenis_kelamin')
                            ->options([
                                'laki-laki' => 'Laki - Laki',
                                'perempuan' => 'Perempuan',
                            ])
                            ->native(false)
                            ->required(),
                        TextInput::make('no_hp')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('asal_kota')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),
                
                Section::make('Pekerjaaan')
                    ->description('Put the user name details in.')
                    ->schema([
                        Radio::make('pekerjaan')
                            ->options([
                                'mahasiswa' => 'Mahasiswa',
                                'dinas/instansi/opd' => 'Dinas/Instansi/OPD', 
                                'peneliti' => 'Peneliti', 
                                'umum' => 'Umum',
                            ])
                            ->reactive()
                            ->required()
                            ->columnSpan(2),
                        // Mahasiswa Fields
                        TextInput::make('jurusan')
                            ->maxLength(255)
                            ->visible(fn ($get) => $get('pekerjaan') === 'mahasiswa'),
                        TextInput::make('asal_universitas')
                            ->maxLength(255)
                            ->visible(fn ($get) => $get('pekerjaan') === 'mahasiswa'),
                        // Dinas/Instansi/OPD Fields
                        TextInput::make('asal')
                            ->maxLength(255)
                            ->visible(fn ($get) => $get('pekerjaan') === 'dinas/instansi/opd'),
                        // Peneliti Fields
                        TextInput::make('asal_universitas_lembaga')
                            ->maxLength(255)
                            ->visible(fn ($get) => $get('pekerjaan') === 'peneliti'),
                        // Umum Fields
                        TextInput::make('organisasi_nama_perusahaan_kantor')
                            ->maxLength(255)
                            ->visible(fn ($get) => $get('pekerjaan') === 'umum'),
                    ])->columns(2),
                    
                    Section::make('Tujuan Kunjungan')
                    ->description('Put the user name details in.')
                    ->schema([
                        CheckboxList::make('tujuan_kunjungan')
                            ->label('Tujuan Kunjungan')
                            ->options([
                                'Permintaan Data/Peta' => 'Permintaan Data/Peta',
                                'Konsultasi_Statistik' => 'Konsultasi Statistik',
                                'Permintaan_Data_Mikro' => 'Permintaan Data Mikro',
                                'Romantik' => 'Romantik',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->live()
                            ->afterStateUpdated(function (Set $set, Get $get) {
                                    $set('tujuan_kunjungan_lainnya', null);
                            })
                            ->reactive()
                            ->required(),
                
                        TextInput::make('tujuan_kunjungan_lainnya')
                            ->label('Lainnya')
                            ->placeholder('Masukkan tujuan kunjungan lainnya')
                            ->live()
                            ->hidden(fn (callable $get) => !in_array('Lainnya', $get('tujuan_kunjungan') ?? []))
                            ->required()
                    ])
                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('nama_lengkap')
                ->numeric()
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('pekerjaan')
                ->searchable()
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListGuestBooks::route('/'),
            'create' => Pages\CreateGuestBook::route('/create'),
            'view' => Pages\ViewGuestBook::route('/{record}'),
            'edit' => Pages\EditGuestBook::route('/{record}/edit'),
        ];
    }
}
