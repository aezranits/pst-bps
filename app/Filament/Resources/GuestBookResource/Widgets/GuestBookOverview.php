<?php

namespace App\Filament\Resources\GuestBookResource\Widgets;

use App\Models\GuestBook;
use App\Models\Role;
use App\Models\RoleUser;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Log;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class GuestBookOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();
        $userId = $user->id;
        $petugasPstRoleId = Role::where('name', 'petugas_pst')->value('id');
        Log::info('test');
        $isPetugasPST = RoleUser::where('user_id', $userId)
                                                    ->where('role_id', $petugasPstRoleId)->exists();

        // Calculate total guest books
        $totalGuestBooks = GuestBook::count();
        
        // Calculate my total guest books for petugas_pst
        $myTotalGuestBooks = $isPetugasPST ? GuestBook::where('petugas_pst_id', $userId)->count() : 0;

        // Calculate in progress guest books
        if ($isPetugasPST) {
            $inProgressGuestBooks = GuestBook::where('petugas_pst_id', $userId)
                ->whereHas('requests', function ($query) {
                    $query->where('status', 'inProgress');
                })->count();
        } else {
            $inProgressGuestBooks = GuestBook::whereHas('requests', function ($query) {
                $query->where('status', 'inProgress');
            })->count();
        }

        // Calculate done guest books
        if ($isPetugasPST) {
            $doneGuestBooks = GuestBook::where('petugas_pst_id', $userId)
                ->whereHas('requests', function ($query) {
                    $query->where('status', 'done');
                })->count();
        } else {
            $doneGuestBooks = GuestBook::whereHas('requests', function ($query) {
                $query->where('status', 'done');
            })->count();
        }

        $stats = [
            Stat::make('Total', $totalGuestBooks)
                ->color('primary'),
            Stat::make('In Progress', $inProgressGuestBooks)
                ->color('warning'),
            Stat::make('Done', $doneGuestBooks)
                ->color('success'),
        ];

        if ($isPetugasPST) {
            $stats[] = Stat::make('My Total GuestBook', $myTotalGuestBooks)
                ->color('info');
        }

        return $stats;
    }
}
