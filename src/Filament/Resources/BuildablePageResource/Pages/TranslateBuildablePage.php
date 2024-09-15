<?php

namespace Pages\Filament\Resources\BuildablePageResource\Pages;

use Pages\Filament\Resources\BuildablePageResource;
use Pages\Filament\Support\CreateOrUpdateTranslation;

class TranslateBuildablePage extends CreateOrUpdateTranslation
{
    protected static string $resource = BuildablePageResource::class;

}
