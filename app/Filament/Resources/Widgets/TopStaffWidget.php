<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TopStaffWidget extends Widget
{
    protected static string $view = 'filament.widgets.top-staff-widget';

    public function getViewData(): array
    {
        $startDate = Carbon::now()->subMonths(3)->startOfMonth();
        $endDate = Carbon::now()->subMonth()->endOfMonth();

        $topPetugasPST = Feedback::select('petugas_pst', DB::raw('AVG(kepuasan_petugas_pst) as avg_rating'), DB::raw('COUNT(*) as guestbook_count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->with('petugasPst')
            ->groupBy('petugas_pst')
            ->orderBy('avg_rating', 'desc')
            ->first();

        $topFrontOffice = Feedback::select('front_office', DB::raw('AVG(kepuasan_petugas_front_office) as avg_rating'), DB::raw('COUNT(*) as guestbook_count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->with('frontOffice')
            ->groupBy('front_office')
            ->orderBy('avg_rating', 'desc')
            ->first();

        return [
            'topPetugasPST' => $topPetugasPST,
            'topFrontOffice' => $topFrontOffice,
        ];
    }
}

