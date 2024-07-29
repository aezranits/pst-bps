<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Filament\Resources\FeedbackResource\RelationManagers;
use App\Models\Feedback;
use App\Models\Role;
use App\Models\User;
use App\UserRoleEnum;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationLabel = 'Feedback';

    protected static ?string $modelLabel = 'Feedbacks';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'System Management';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('requests_id')
                    ->relationship('requests', 'id')
                    ->hiddenOn('edit')
                    ->required(),
                Select::make('petugas_pst_id')
                    ->options(function ($record) {
                        $petugasPstRoleId = Role::where('name', 'petugas_pst')->value('id');

                        return User::whereHas('roles', function($query) use ($petugasPstRoleId) {
                                $query->where('roles.id', $petugasPstRoleId);
                            })->pluck('name', 'id');
                    })
                    ->searchable()
                    ->required(),
                Select::make('front_office_id')
                    ->options(function ($record) {
                        $frontOfficeRoleId = Role::where('name', 'front_office')->value('id');

                        return User::whereHas('roles', function($query) use ($frontOfficeRoleId) {
                                $query->where('roles.id', $frontOfficeRoleId);
                            })->pluck('name', 'id');
                    })
                    ->required(),
                TextInput::make('kepuasan_petugas_pst')
                    ->required()
                    ->numeric(),
                TextInput::make('kepuasan_petugas_front_office')
                    ->required()
                    ->numeric(),
                TextInput::make('kepuasan_sarana_prasarana')
                    ->required()
                    ->numeric(),
                Textarea::make('kritik_saran')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('requests_id')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('petugas_pst_id')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('front_office_id')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('kepuasan_petugas_pst')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('kepuasan_petugas_front_office')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('kepuasan_sarana_prasarana')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
            'index' => Pages\ListFeedback::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            'view' => Pages\ViewFeedback::route('/{record}'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }
}
