<?php

namespace App\Filament\Widgets;

use App\Models\GuestBook;
use App\Models\Feedback;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Log;

class WelcomeWidget extends Widget
{
    // protected $columnSpan = 'full';
    protected static string $view = 'filament.widgets.welcome-widget';

    public function getViewData(): array
    {
        $user = auth()->user();
        $userId = $user->id;
        $userRole = $user->getRoleNames()->first();
        $doneGuestBooks = GuestBook::where('petugas_pst', $userId)
            ->where('status', 'done') // Check the status directly
            ->count();

        $feedbackRating = Feedback::where('petugas_pst', $userId)->avg('kepuasan_petugas_pst');

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $userRole,
            'doneGuestBooks' => $doneGuestBooks,
            'feedbackRating' => number_format($feedbackRating, 2),
        ];

        return $data;
    }
}

