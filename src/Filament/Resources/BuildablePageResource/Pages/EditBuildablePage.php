<?php

namespace Pages\Filament\Resources\BuildablePageResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Pages\Filament\Resources\BuildablePageResource;
use Pages\Filament\Resources\StaticPageResource;
use Pages\Filament\Support\EditPage;
use Pages\Models\Page;
use Pages\Models\StaticPage;

class EditBuildablePage extends EditPage
{
    protected static string $resource = BuildablePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\Action::make('edit')
            //     ->label('Visita')
            //     ->url(fn (StaticPage $staticPage): string => url($staticPage->page->url), true),
            Actions\DeleteAction::make(),
        ];
    }
}
