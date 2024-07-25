<?php

namespace App\Filament\Resources\GuestBookResource\Pages;

use App\Enum\StatusRequestEnum;
use App\Filament\Resources\GuestBookResource;
use App\Models\Feedback;
use App\Models\Request;
use Error;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class CreateGuestBook extends CreateRecord
{
    protected static string $resource = GuestBookResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $record =  static::getModel()::create($data);
        try {
            $request = new Request();
            $request['guest_book_id'] = $record->id;
            $request['status'] = StatusRequestEnum::PENDING;
            
            $request->save();
    
            $feedback = new Feedback();
            $feedback['requests_id'] = $request->id;
            
            $feedback->save();
    
            return $record;
        } catch (Error $e) {
            Log::error("Error in CreateGuestBook : ".$e);
        }
        
    }

}
