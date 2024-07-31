<?php

namespace App\Filament\Widgets;

use App\Models\GuestBook;
use App\Models\Feedback;
use Filament\Widgets\Widget;

class WelcomeWidget extends Widget
{
    // protected $columnSpan = 'full';
    protected static string $view = 'filament.widgets.welcome-widget';

    public function getViewData(): array
    {
        $user = auth()->user();
        $userId = $user->id;
        $role = $user->roles->pluck('description')->first();
        $doneGuestBooks = GuestBook::where('petugas_pst_id', $userId)
            ->whereHas('requests', function ($query) {
                $query->where('status', 'done');
            })->count();

        $feedbackRating = Feedback::where('petugas_pst_id', $userId)->avg('kepuasan_petugas_pst');

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $role,
            'doneGuestBooks' => $doneGuestBooks,
            'feedbackRating' => number_format($feedbackRating, 2),
        ];


        return $data;
    }
}

