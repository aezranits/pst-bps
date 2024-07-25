<?php

namespace App\Enum;

use Filament\Support\Contracts\HasLabel;

enum StatusRequestEnum: string implements HasLabel
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'inProgress';
    case DONE = 'done';
    case CANCELED = 'canceled';
    case FAILED = 'failed';
    
    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::IN_PROGRESS => 'In Progress',
            self::DONE => 'Done',
            self::CANCELED => 'Canceled',
            self::FAILED => 'Failed',
        };
    }
}
