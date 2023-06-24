<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;

class ManageTasks extends ManageRecords
{
    protected static string $resource = TaskResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->slideOver()
                ->using(function (array $data): Model {
                    $data['user_id'] = auth()->id();
                    return static::getModel()::create($data);
                })
                ->successNotificationTitle('Task has been created.'),
        ];
    }
}
