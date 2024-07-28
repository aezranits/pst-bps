<?php

namespace App\Filament\Resources\RequestResource\Pages;

use App\Filament\Resources\RequestResource;
use App\Mail\MailableName;
use App\Models\GuestBook;
use Error;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EditRequest extends EditRecord
{
    protected static string $resource = RequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function sendEmailFeedback($email, $message, $subject, $name){
        Mail::to($email)->send(new MailableName($message, $subject, $name));
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        try {
            if($data['status'] === 'done'){
                $guestBook = GuestBook::find($data['guest_book_id']);

                if ($guestBook) {
                    $emailGuest = $guestBook['email'];
                    $nameGuest = $guestBook['nama_lengkap'];
                    $messageGuest = "Link Feedback PST";
                    $subjectGuest = "Link feedback PST";
                
                    $this->sendEmailFeedback($emailGuest, $messageGuest, $subjectGuest, $nameGuest);
                } else {
                    Log::error('GuestBook dengan id '. ${$data['guest_book_id']} .' tidak ditemukan.');
                }
            }
            
            $record->update($data);
            return $record;
        } catch (Error $e) {
            Log::error("Error in EditRequest : ".$e);
        }
       

       
    }
}
