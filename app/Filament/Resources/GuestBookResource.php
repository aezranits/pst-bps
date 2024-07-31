<?php

namespace App\Filament\Resources;

use App\Enum\StatusRequestEditEnum;
use App\Enum\StatusRequestEnum;
use App\Filament\Resources\GuestBookResource\Pages;
use App\Filament\Resources\GuestBookResource\Widgets\GuestBookOverview;
use App\Models\GuestBook;
use App\Models\Request;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\SelectAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GuestBookResource extends Resource
{
    protected static ?string $model = GuestBook::class;

    protected static ?string $navigationLabel = 'Guest Book';

    protected static ?string $modelLabel = 'Guest Books';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'System Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make('Identitas Pribadi')
                            ->description('Put the user name details in.')
                            ->schema([
                                TextInput::make('id')->hidden(),
                                TextInput::make('nama_lengkap')->label('Nama Lengkap')->required()->maxLength(255)->columnSpan(2),
                                Select::make('jenis_kelamin')
                                    ->label('Jenis Kelamin')
                                    ->options([
                                        'laki-laki' => 'Laki - Laki',
                                        'perempuan' => 'Perempuan',
                                    ])
                                    ->native(false)
                                    ->required(),
                                TextInput::make('usia')->required()->numeric(),
                                TextInput::make('email')->label('Email')->email()->required()->maxLength(255),
                                TextInput::make('no_hp')->label('No. HP')->required()->maxLength(255),
                                TextInput::make('asal_kota')->label('Alamat')->required()->maxLength(255)->columnSpanFull(),
                            ])
                            ->columns(2),

                        Section::make('Pekerjaan')
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
                                TextInput::make('jurusan')->maxLength(255)->visible(fn($get) => $get('pekerjaan') === 'mahasiswa'),
                                TextInput::make('asal_universitas')->label('Asal Universitas')->maxLength(255)->visible(fn($get) => $get('pekerjaan') === 'mahasiswa'),
                                // Dinas/Instansi/OPD Fields
                                TextInput::make('asal')->label('Asal')->maxLength(255)->visible(fn($get) => $get('pekerjaan') === 'dinas/instansi/opd')->columnSpanFull(),
                                // Peneliti Fields
                                TextInput::make('asal_universitas_lembaga')->label('Asal Universitas/Lembaga')->maxLength(255)->visible(fn($get) => $get('pekerjaan') === 'peneliti')->columnSpanFull(),
                                // Umum Fields
                                TextInput::make('organisasi_nama_perusahaan_kantor')->label('Organisasi/Nama Perusahaan/Kantor')->maxLength(255)->visible(fn($get) => $get('pekerjaan') === 'umum')->columnSpanFull(),
                            ])
                            ->columns(2),

                        Section::make('Tujuan Kunjungan')
                            ->description('Put the user name details in.')
                            ->schema([
                                CheckboxList::make('tujuan_kunjungan')
                                    ->label('Tujuan Kunjungan')
                                    ->options([
                                        'permintaan_data/peta' => 'Permintaan Data/Peta',
                                        'konsultasi_statistik' => 'Konsultasi Statistik',
                                        'permintaan_data_mikro' => 'Permintaan Data Mikro',
                                        'romantik' => 'Romantik',
                                        'lainnya' => 'Lainnya',
                                    ])
                                    ->live()
                                    ->afterStateUpdated(function (Set $set, Get $get) {
                                        $set('tujuan_kunjungan_lainnya', null);
                                    })
                                    ->reactive()
                                    ->required(),

                                TextInput::make('tujuan_kunjungan_lainnya')->label('Tujuan Kunjungan Lainnya')->placeholder('Masukkan tujuan kunjungan lainnya')->live()->hidden(fn(callable $get) => !in_array('Lainnya', $get('tujuan_kunjungan') ?? []))->required(),
                            ]),
                    ])
                    ->columnSpan(fn($state, $livewire) => $livewire instanceof ViewRecord ? 3 : 2),
                Group::make()
                    ->schema([
                        Section::make('Status Buku Tamu')
                            ->description('Tentukan status buku tamu')
                            ->schema([
                                ToggleButtons::make('status')
                                    ->options(StatusRequestEditEnum::class)
                                    ->colors([
                                        'pending' => 'info',
                                        'inProgress' => 'warning',
                                        'done' => 'success',
                                    ])
                                    ->icons([
                                        'pending' => 'heroicon-m-information-circle',
                                        'inProgress' => 'heroicon-m-arrow-path',
                                        'done' => 'heroicon-m-check-badge',
                                    ])
                                    ->default(function () {
                                        if ('create') {
                                            return 'pending';
                                        }
                                    })
                                    ->inline()
                                    ->required(),
                                Textarea::make('response')->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(1)
                    ->hiddenOn('view'),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        $userLogin = auth()->user();
        $petugasPstRoleId = Role::where('name', 'petugas_pst')->value('id');
        $isPetugasPst = RoleUser::where('user_id', $userLogin->id)
                                                    ->where('role_id', $petugasPstRoleId)->exists();

        $table = $table
            ->columns([
                TextColumn::make('nama_lengkap')->searchable()->sortable()->label('Nama Lengkap'),
                TextColumn::make('email')->searchable()->sortable()->label('Email Address'),
                TextColumn::make('pekerjaan')
                    ->searchable()
                    ->sortable()
                    ->label('Pekerjaan')
                    ->getStateUsing(function ($record) {
                        $options = [
                            'mahasiswa' => 'Mahasiswa',
                            'dinas/instansi/opd' => 'Dinas/Instansi/OPD',
                            'peneliti' => 'Peneliti',
                            'umum' => 'Umum',
                        ];

                        return $options[$record->pekerjaan] ?? $record->pekerjaan;
                    }),
                TextColumn::make('created_at')->dateTime()->sortable()->label('Tanggal Pengisian'),
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
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([ActionGroup::make([ViewAction::make(), EditAction::make(), DeleteAction::make()])])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);

        if ($isPetugasPst) {
            $table = $table->filters([
                Filter::make('my_guest_book')
                    ->query(function (Builder $query) use ($petugasPstRoleId) {
                        $user = auth()->user();
                        
                        if ($user && $petugasPstRoleId) {
                            $isPetugasPst = RoleUser::where('user_id', $user->id)
                                                    ->where('role_id', $petugasPstRoleId)->exists();
    
                            if ($isPetugasPst) {
                                return $query->where('petugas_pst_id', $user->id);
                            }
                        }
                        return $query; // Show all records if not petugas_pst or user not found
                    })
            ]);
        }

        return $table;
    }

    public static function getRelations(): array
    {
        return [
                //
            ];
    }

    public static function getWidgets(): array
    {
        return [GuestBookOverview::class];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGuestBooks::route('/'),
            'create' => Pages\CreateGuestBook::route('/create'),
            // 'view' => Pages\ViewGuestBook::route('/{record}'),
            'edit' => Pages\EditGuestBook::route('/{record}/edit'),
        ];
    }
}
