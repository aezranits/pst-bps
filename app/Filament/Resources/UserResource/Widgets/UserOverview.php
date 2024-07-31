<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\RoleUser;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserOverview extends BaseWidget
{
    

    protected function getStats(): array
    {
        return [
            Stat::make('Admin', RoleUser::query()->where('role_id', 1)->count()),
            Stat::make('Petugas PST', RoleUser::query()->where('role_id', 2)->count()),
            Stat::make('Front Office', RoleUser::query()->where('role_id', 3)->count()),
        ];
    }
}
