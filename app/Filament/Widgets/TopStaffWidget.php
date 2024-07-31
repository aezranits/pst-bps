<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use App\Models\User;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TopStaffWidget extends Widget
{
    protected static string $view = 'filament.widgets.top-staff-widget';


    public function getViewData(): array
    {
        $topPetugasPST = Feedback::select('petugas_pst_id', DB::raw('AVG(kepuasan_petugas_pst) as avg_rating'), DB::raw('COUNT(*) as guestbook_count'))
            ->groupBy('petugas_pst_id')
            ->orderBy('avg_rating', 'desc')
            ->first();
        $topPetugasPST->name = User::where('id',$topPetugasPST->petugas_pst_id)->pluck('name')->first();
        $topFrontOffice = Feedback::select('front_office_id', DB::raw('AVG(kepuasan_petugas_front_office) as avg_rating'), DB::raw('COUNT(*) as guestbook_count'))
            ->groupBy('front_office_id')
            ->orderBy('avg_rating', 'desc')
            ->first();
        $topFrontOffice->name = User::where('id',$topFrontOffice->front_office_id)->pluck('name')->first();

        return [
            'topPetugasPST' => $topPetugasPST,
            'topFrontOffice' => $topFrontOffice,
        ];
    }
}

