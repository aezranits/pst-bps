<?php

namespace App\Filament\Resources\FeedbackResource\Widgets;

use App\Models\Feedback;
use App\Models\Role;
use App\Models\RoleUser;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FeedbackOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();
        $userId = $user->id;
        $petugasPstRoleId = Role::where('name', 'petugas_pst')->value('id');
        $frontOfficeRoleId = Role::where('name', 'front_office')->value('id');
        $isPetugasPst = RoleUser::where('user_id', $userId)
                                                    ->where('role_id', $petugasPstRoleId)->exists();
        $isFrontOffice = RoleUser::where('user_id', $userId)
                                                    ->where('role_id', $frontOfficeRoleId)->exists();        
        // Calculate My Rating Pelayanan
        if ($isPetugasPst) {
            // Petugas PST
            $userFeedbacks = Feedback::where('petugas_pst_id', $userId)->get();
            $myRatingPelayanan = $userFeedbacks->avg('kepuasan_petugas_pst');
        } elseif ($isFrontOffice) {
            // Front Office
            $userFeedbacks = Feedback::where('front_office_id', $userId)->get();
            $myRatingPelayanan = $userFeedbacks->avg('kepuasan_petugas_front_office');
        } else {
            $myRatingPelayanan = 0;
        }

        // Calculate Total Rating Pelayanan Petugas PST
        $totalRatingPelayananPST = Feedback::where('petugas_pst_id', 2)->avg('kepuasan_petugas_pst');

        // Calculate Total Rating Pelayanan Petugas Front Office
        $totalRatingPelayananFrontOffice = Feedback::where('front_office_id', 3)->avg('kepuasan_petugas_front_office');

        // Calculate Total Rating Sarana Prasaran
        $totalRatingSaranaPrasarana = Feedback::avg('kepuasan_sarana_prasarana');

        return [
            Stat::make('My Rating Pelayanan', $myRatingPelayanan? number_format($myRatingPelayanan,2).'/5' : '0/5'),
            Stat::make('Total Rating Pelayanan Petugas PST', $totalRatingPelayananPST?number_format($totalRatingPelayananPST,2).'/5'  : '0/5'),
            Stat::make('Total Rating Pelayanan Petugas Front Office', $totalRatingPelayananFrontOffice ? number_format($totalRatingPelayananFrontOffice,2).'/5' : '0/5'),
            Stat::make('Total Rating Sarana Prasarana', $totalRatingSaranaPrasarana ? number_format($totalRatingSaranaPrasarana,2).'/5' : '0/5'),
        ];
    }
}
