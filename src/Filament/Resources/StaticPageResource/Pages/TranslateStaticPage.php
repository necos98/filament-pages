<?php

namespace Pages\Filament\Resources\StaticPageResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Pages\Filament\Resources\StaticPageResource;
use Pages\Filament\Support\CreateOrUpdateTranslation;
use Pages\Filament\Support\CreatePage;
use Pages\Models\StaticPage;

class TranslateStaticPage extends CreateOrUpdateTranslation
{
    protected static string $resource = StaticPageResource::class;

}
