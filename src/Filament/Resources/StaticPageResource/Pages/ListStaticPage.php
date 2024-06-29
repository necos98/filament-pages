<?php

namespace Pages\Filament\Resources\StaticPageResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Pages\Filament\Resources\StaticPageResource;
use Pages\Models\StaticPage;

class ListStaticPage extends ListRecords
{
    protected static string $resource = StaticPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
