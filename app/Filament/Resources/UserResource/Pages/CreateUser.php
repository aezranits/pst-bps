<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Role;
use App\Models\RoleUser;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $record =  static::getModel()::create($data);

        $roleUser = new RoleUser();
        $roleUser['user_id'] = $record->id;
        $roleUser['role_id'] = $data['role'];
        
        $roleUser->save();

        return $record;
    }
}
