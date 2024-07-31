<?php

namespace App\Filament\Resources;

use App\Enum\StatusRequestEnum;
use App\Filament\Resources\FeedbackResource\Pages;
use App\Filament\Resources\FeedbackResource\RelationManagers;
use App\Filament\Resources\FeedbackResource\Widgets\FeedbackOverview;
use App\Models\Feedback;
use App\Models\Request;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\UserRoleEnum;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationLabel = 'Feedback';

    protected static ?string $modelLabel = 'Feedbacks';

    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';

    protected static ?string $navigationGroup = 'System Management';

    protected static ?int $navigationSort = 3;

    

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('nama_lengkap')->relationship('requests', 'id')->hiddenOn('edit')->required(),
            Select::make('petugas_pst_id')
                ->options(function ($record) {
                    $petugasPstRoleId = Role::where('name', 'petugas_pst')->value('id');

                    return User::whereHas('roles', function ($query) use ($petugasPstRoleId) {
                        $query->where('roles.id', $petugasPstRoleId);
                    })->pluck('name', 'id');
                })
                ->searchable()
                ->required(),
            Select::make('front_office_id')
                ->options(function ($record) {
                    $frontOfficeRoleId = Role::where('name', 'front_office')->value('id');

                    return User::whereHas('roles', function ($query) use ($frontOfficeRoleId) {
                        $query->where('roles.id', $frontOfficeRoleId);
                    })->pluck('name', 'id');
                })
                ->required(),
            TextInput::make('kepuasan_petugas_pst')->required()->numeric(),
            TextInput::make('kepuasan_petugas_front_office')->required()->numeric(),
            TextInput::make('kepuasan_sarana_prasarana')->required()->numeric(),
            Textarea::make('kritik_saran')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        $userLogin = auth()->user();
        $adminId = Role::where('name', 'admin')->value('id');
        

        $isAdmin = RoleUser::where('user_id', $userLogin->id)
                                                    ->where('role_id', $adminId)->exists();
        $table = $table
            ->columns([
                TextColumn::make('nama_lengkap')->searchable()->sortable()->label('Nama Lengkap'),
                TextColumn::make('petugas_pst_id')->searchable()->sortable()->label('Petugas PST'),
                TextColumn::make('front_office_id')->searchable()->sortable()->label('Front Office'),
                TextColumn::make('created_at')->dateTime()->sortable()->label('Tanggal Pengisian'),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([ActionGroup::make([ViewAction::make(), EditAction::make(), DeleteAction::make()])])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);

        if (!$isAdmin) {
            $table = $table->filters([
                Filter::make('my_feedback')
                    ->query(function (Builder $query) {
                        $user = auth()->user();
                        $petugasPstRoleId = Role::where('name', 'petugas_pst')->value('id');
                        $frontOfficeRoleId = Role::where('name', 'front_office')->value('id');
                        if ($user && $petugasPstRoleId) {
                            $isPetugasPst = RoleUser::where('user_id', $user->id)
                                                    ->where('role_id', $petugasPstRoleId)->exists();
    
                            if ($isPetugasPst) {
                                return $query->where('petugas_pst_id', $user->id);
                            }
                        }elseif(($user && $frontOfficeRoleId)) {
                            $isPetugasPst = RoleUser::where('user_id', $user->id)
                                                    ->where('role_id', $frontOfficeRoleId)->exists();
    
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
        return [FeedbackOverview::class];
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
