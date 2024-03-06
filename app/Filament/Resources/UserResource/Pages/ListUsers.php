<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->color('info'),
            Action::make('Factory')
                ->label('Factory Fill')
                ->color('success')
                ->icon('heroicon-o-beaker')
                ->action(fn () => User::factory(50)->create()),
        ];
    }
}
