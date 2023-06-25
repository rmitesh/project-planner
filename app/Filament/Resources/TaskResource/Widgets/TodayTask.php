<?php

namespace App\Filament\Resources\TaskResource\Widgets;

use App\Filament\Resources\TaskResource;
use App\Models\Task;
use Closure;
use Filament\Forms;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class TodayTask extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = "Today's Tasks";

    protected $listeners = [
        'updateTodayTaskEvent' => '$refresh',
    ];

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableQuery(): Builder
    {
        return TaskResource::getEloquentQuery('today')
            ->where('created_at', 'LIKE', '%'. now()->format('Y-m-d') .'%')
            ->oldest('status')
            ->latest();
    }

    protected function getTableHeaderActions(): array
    {
        return [
            Tables\Actions\Action::make('View All')
                ->icon('heroicon-o-external-link')
                ->iconPosition('after')
                ->url(route('filament.resources.tasks.index')),

            Tables\Actions\CreateAction::make()
                ->form(TaskResource::getForm())
                ->slideOver()
                ->successNotificationTitle('Task has been updated.'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make()
                ->form(TaskResource::getForm())
                ->slideOver()
                ->successNotificationTitle('Task has been updated.'),
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\CheckboxColumn::make('status'),

            Tables\Columns\TextColumn::make('note')
                ->limit(40),

            Tables\Columns\TextColumn::make('project.title')
                ->placeholder('-'),
            
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime('dS F, Y h:i A'),
        ];
    }
}
