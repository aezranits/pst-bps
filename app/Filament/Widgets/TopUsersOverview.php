<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TopUsersOverview extends BaseWidget
{
    protected function findTopUserByAverageSatisficationAndTotalFeedback($petugasRole)
    {
        // Calculate average satisfaction and feedback count for each user
        if($petugasRole['name'] === 'petugas_pst' ){
            $userStats = Feedback::select('petugas_pst_id as user_id', DB::raw('AVG(kepuasan_petugas_pst) as avg_satisfaction'), DB::raw('COUNT(id) as feedback_count'))
            ->groupBy('user_id')
            ->get();
        }elseif($petugasRole['name'] === 'front_office'){
            $userStats = Feedback::select('front_office_id as user_id', DB::raw('AVG(kepuasan_petugas_front_office) as avg_satisfaction'), DB::raw('COUNT(id) as feedback_count'))
            ->groupBy('user_id')
            ->get();
        }
        
        // Find the user with the highest average satisfaction
        $highestSatisfactionUser = $userStats->sortByDesc('avg_satisfaction')->first();

        if ($highestSatisfactionUser) {
            // From those users, find the one with the highest feedback count
            $topPetugas = $userStats->where('avg_satisfaction', $highestSatisfactionUser->avg_satisfaction)
                ->sortByDesc('feedback_count')
                ->first();
            
            
            // Ensure the user has the role 'petugas_pst'
            $topPetugasUser = User::whereHas('roles', function ($query) use ($petugasRole) {
                $query->where('role_id', $petugasRole['id']);
            })->where('id', $topPetugas->user_id)
              ->first();
        
            $result = [
                'Top Petugas PST' => $topPetugasUser ? $topPetugasUser->name : 'N/A',
                'Average Satisfaction' => $topPetugas ? $topPetugas->avg_satisfaction : 'N/A',
                'Feedback Count' => $topPetugas ? $topPetugas->feedback_count : 'N/A',
            ];
        } else {
            $result = [
                'Top Petugas PST' => 'N/A',
                'Average Satisfaction' => 'N/A',
                'Feedback Count' => 'N/A',
            ];
        }

        return $result;
    }

    protected function getStats(): array
    {   
        $petugasPSTRole = Role::where('name', 'petugas_pst')->first();
        $petugasPSTTerbaik = $this->findTopUserByAverageSatisficationAndTotalFeedback($petugasPSTRole);
        
        $petugasFrontOfficeRole = Role::where('name', 'front_office')->first();
        $petugasFrontOfficeTerbaik = $this->findTopUserByAverageSatisficationAndTotalFeedback($petugasFrontOfficeRole);

        
        return [
            Stat::make('Petugas PST Terbaik', $petugasPSTTerbaik['Top Petugas PST']),
            Stat::make('Front Office Terbaik', $petugasFrontOfficeTerbaik['Top Petugas PST']),
        ];
    }
}
