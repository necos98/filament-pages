<?php

namespace Pages\Filament\Resources\StaticPageResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Pages\Filament\Resources\StaticPageResource;
use Pages\Models\Page;
use Pages\Models\StaticPage;

class EditStaticPage extends EditRecord
{
    protected static string $resource = StaticPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('edit')
                ->label('Visita')
                ->url(fn (StaticPage $staticPage): string => url($staticPage->page->url), true),
            Actions\DeleteAction::make(),
        ];
    }
}
