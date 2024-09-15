<?php

namespace Pages;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\PanelProvider;
use Pages\Filament\Resources\BuildablePageResource;
use Pages\Filament\Resources\StaticPageResource;

class PagesPlugin implements Plugin
{
    public static function make(){
        return new PagesPlugin;
    }

    public function getId(): string
    {
        return 'pages';
    }
 
    public function register(Panel $panel): void
    {
        // dd("a");
        $panel
            ->resources([
                StaticPageResource::class,
                // BuildablePageResource::class
                // PostResource::class,
                // CategoryResource::class,
            ])
            ->pages([
                // Settings::class,
            ]);
    }
 
    public function boot(Panel $panel): void
    {
        //
    }
}
