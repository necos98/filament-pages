<?php

namespace Pages\Filament\Resources\BuildablePageResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Pages\Filament\Resources\BuildablePageResource;
use Pages\Filament\Resources\StaticPageResource;
use Pages\Models\StaticPage;

class ListBuildablePage extends ListRecords
{
    protected static string $resource = BuildablePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
