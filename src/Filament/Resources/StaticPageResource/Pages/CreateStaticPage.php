<?php

namespace Pages\Filament\Resources\StaticPageResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Pages\Filament\Resources\StaticPageResource;
use Pages\Filament\Support\CreatePage;
use Pages\Models\StaticPage;

class CreateStaticPage extends CreatePage
{
    protected static string $resource = StaticPageResource::class;
}
